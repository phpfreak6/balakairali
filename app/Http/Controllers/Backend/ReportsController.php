<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Quarter;
use App\Models\Centre;
use App\Models\Classes as ClassModel;
use App\Models\User;
use App\Models\Fee;
use DataTables;
use Mail;
use PDF;
use DB;
use Carbon\Carbon;

class ReportsController extends Controller {

    public function attendanceReport(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            if (empty($data['term']) && empty($data['year'])) {
                return DataTables::of([])->make(true);
            }
            $selectedterm = $data['term'];
            $year = $data['year'];
            $term = Quarter::where('id', $selectedterm)->first();
            $attendance = User::whereRole(User::STUDENT);
            $student = '';
            $start = $year . '-' . $term->start_date;
            $end = $year . '-' . $term->end_date;
            if ($start <= date('Y-m-d') && $end >= date('Y-m-d')) {
                $end = date('Y-m-d') . ' 23:59:59';
            }
            if (!empty($data['student_name']) && !empty($selectedterm) && !empty($year)) {
                $class = $request->classe;
                $centre = $request->centre;
                $name = $data['student_name'];
                if (is_numeric($name)) {
                    $attendance->whereHas('attend', function ($q) use ($start, $end, $class, $centre) {
                        $q->whereDate('attendance_date', '>=', $start);
                        $q->whereDate('attendance_date', '<=', $end);
                        $q->where('centre_id', $centre);
                        $q->where('classes_id', $class);
                    })->where('id', $name);
                } else {
                    $attendance->where('name', 'LIKE', '%' . $name . '%')
                            ->whereHas('attend', function ($q) use ($start, $end, $class, $centre) {
                                $q->where('attendance_date', '>=', $start);
                                $q->where('attendance_date', '<=', $end);
                                $q->where('centre_id', $centre);
                                $q->where('classes_id', $class);
                            });
                }
            } elseif (empty($data['student_name']) && !empty($selectedterm) && !empty($year)) {
                $class = $request->classe;
                $centre = $request->centre;
                $attendance->whereHas('attend', function ($q) use ($start, $end, $class, $centre) {
                    $q->whereDate('attendance_date', '>=', $start);
                    $q->whereDate('attendance_date', '<=', $end);
                    $q->where('centre_id', $centre);
                    $q->where('classes_id', $class);
                });
            }
            if (isset($request->mail)) {
                $csv = Attendance::attendanceMail($start, $end, $attendance->get());
                return $csv;
            }
            $query = $attendance->get();
            return DataTables::of($query)
                            ->addColumn('name', function (User $user) {
                                return $user->name;
                            })
                            ->addColumn('dob', function (User $user) {
                                return date('d-m-Y', strtotime($user->dob));
                            })
                            ->addColumn('main_school', function (User $user) {
                                return $user->student->main_school;
                            })
                            ->addColumn('main_class', function (User $user) {
                                return $user->student->main_class;
                            })
                            ->addColumn('centre', function (User $user) {
                                return $user->student->centres->name;
                            })
                            ->addColumn('class', function (User $user) {
                                return $user->student->studentclasses->name;
                            })
                            ->addColumn('no_of_attended_classes', function (User $user) use ($start, $end) {

                                return Attendance::classAttendCount($start, $end, $user->id)['total'];
                            })
                            ->addColumn('percentage', function (User $user) use ($start, $end) {

                                return Attendance::classAttendCount($start, $end, $user->id)['percentage'];
                            })->addIndexColumn()->rawColumns(['actions'])->with('posts', 100)->make(true);
        }
        $quarters = Quarter::get();
        $centres = Centre::get();
        $classes = ClassModel::get();
        $title = 'Balakairali - Attendance Report';
        return view('reports.attendance', compact('quarters', 'classes', 'centres', 'title'));
    }

    public function paymentReport(Request $request) {
        $dataArr['centre'] = $request->centre ?? NULL;
        $dataArr['pay_year'] = $request->pay_year ?? NULL;
        $dataArr['pay_term'] = $request->pay_term ?? NULL;
        $dataArr['class'] = $request->classes ?? NULL;
        $dataArr['payment_status'] = $request->payment_status ?? NULL;
        $dataArr['student_status'] = $request->student_status ?? NULL;
        $dataArr['centresDropdownArr'] = getDropdownList(Centre::get(), 'id', 'name');
        $dataArr['termsDropdownArr'] = getDropdownList(Quarter::get(), 'id', 'id');
        $dataArr['classesDropdownArr'] = getDropdownList(ClassModel::get(), 'id', 'name');
        return view('reports.payment', $dataArr);
    }

    public function generateInvoice($id) {
        $payment = Fee::whereId($id)->first();
        if ($payment->invoice_type == 'family') {
            $sIds = Fee::where('invoice_number', $payment->invoice_number)->pluck('user_id')->all();
            $users = User::whereIn('id', $sIds)->get();
        } else {
            $users = [];
        }
        $pdf = PDF::loadView('reports.pdf.invoice', compact('payment', 'users'));
        return $pdf->download('INVOICE-' . $payment->invoice_number . '.pdf');
    }

    public function mailInvoice($id) {
        $payment = Fee::whereId($id)->first();
        if ($payment->invoice_type == 'family') {
            $sIds = Fee::where('invoice_number', $payment->invoice_number)->pluck('user_id')->all();
            $users = User::whereIn('id', $sIds)->get();
        } else {
            $users = [];
        }
        $pdf = PDF::loadView('reports.pdf.invoice', compact('payment', 'users'));
        Mail::send('emails.invoice', ['payment' => $payment, 'users' => $users], function ($message) use ($payment, $pdf) {
            $message->to($payment->user->student->p1_email, 'User')
                    ->subject('PAYMENT RECEIVED')
                    ->attachData($pdf->output(), "invoice-" . $payment->invoice_number . ".pdf");
        });
        if (Mail::failures()) {
            session()->flash('error', 'Email not Sent !');
            return redirect()->back();
        }
        session()->flash('success', 'Email sent !');
        return redirect()->back();
    }

    public function totalClasses(Request $request) {
        $data = $request->all();
        $selectedterm = $data['term'];
        $year = $data['year'];
        $term = Quarter::where('id', $selectedterm)->first();
        $start = $year . '-' . $term->start_date;
        $end = date('Y-m-d');
        $totalClasses = ClassModel::totalClasses($start, $end);
        return $totalClasses;
    }

    public function getPaymentReportsDatatable(Request $request) {
        switch ($request->payment_status) {
            case '2':
                /* Get Paid Student Ids */
                $query = DB::table('fees')
                        ->join('users', 'users.id', '=', 'fees.user_id')
                        ->join('student_details', 'student_details.user_id', '=', 'fees.user_id')
                        ->join('centres', 'centres.id', '=', 'student_details.centre')
                        ->join('classes', 'classes.id', '=', 'student_details.classes');
                $request->student_status !== '3' ? $query->where('users.status', '=', $request->student_status) : '';
                !empty($request->centre) ? $query->where('centres.id', '=', $request->centre) : '';
                !empty($request->classes) ? $query->where('classes.id', '=', $request->classes) : '';
                !empty($request->pay_term) ? $query->where('fees.pay_term', '=', $request->pay_term) : '';
                !empty($request->pay_year) ? $query->where('fees.pay_year', '=', $request->pay_year) : '';
                $paidStudentIds = $query->select('fees.*', 'users.first_name', 'users.last_name', 'student_details.p1_email', 'classes.name as class_name', 'centres.name as centre_name')
                                ->pluck('user_id')->toArray() ?? [];

                /* Get Unpaid Student Ids */
                $unpaid_students_query = DB::table('users')
                        ->join('student_details', 'student_details.user_id', '=', 'users.id')
                        ->join('centres', 'centres.id', '=', 'student_details.centre')
                        ->join('classes', 'classes.id', '=', 'student_details.classes')
                        ->whereNotIn('users.id', $paidStudentIds);
                $request->student_status !== '3' ? $unpaid_students_query->where('users.status', '=', $request->student_status) : '';
                !empty($request->centre) ? $unpaid_students_query->where('centres.id', '=', $request->centre) : '';
                !empty($request->classes) ? $unpaid_students_query->where('classes.id', '=', $request->classes) : '';
                $resultArr = $unpaid_students_query->select('users.first_name', 'users.last_name', 'student_details.p1_email', 'classes.name as class_name', 'centres.name as centre_name')->get();
                break;

            default:
                $query = DB::table('fees')
                        ->join('users', 'users.id', '=', 'fees.user_id')
                        ->join('student_details', 'student_details.user_id', '=', 'fees.user_id')
                        ->join('centres', 'centres.id', '=', 'student_details.centre')
                        ->join('classes', 'classes.id', '=', 'student_details.classes');
                $request->student_status !== '3' ? $query->where('users.status', '=', $request->student_status) : '';
                !empty($request->centre) ? $query->where('centres.id', '=', $request->centre) : '';
                !empty($request->classes) ? $query->where('classes.id', '=', $request->classes) : '';
                !empty($request->pay_term) ? $query->where('fees.pay_term', '=', $request->pay_term) : '';
                !empty($request->pay_year) ? $query->where('fees.pay_year', '=', $request->pay_year) : '';
                $resultArr = $query->select('fees.*', 'users.first_name', 'users.last_name', 'student_details.p1_email', 'classes.name as class_name', 'centres.name as centre_name')
                        ->orderBy('fees.created_at', 'DESC')
                        ->get();
                break;
        }
        return DataTables::of($resultArr)
                        ->addColumn('combined_name', function ($query) {
                            return $query->first_name . ' ' . $query->last_name;
                        })
                        ->addColumn('payment_date', function ($query) {
                            if (!empty($query->created_at)) {
                                return Carbon::parse($query->created_at)->format('d-M-Y');
                            }
                            return 'N/A';
                        })
                        ->make(true);
    }

}
