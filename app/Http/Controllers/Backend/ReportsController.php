<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Quarter;
use App\Models\Centre;
use App\Models\Classes as ClassModel;
use App\Models\User;
use App\Models\StudentDetail;
use App\Models\Fee;
use DataTables;
use Mail;
use PDF;

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
                            ->addColumn('name', function(User $user) {
                                return $user->name;
                            })
                            ->addColumn('dob', function(User $user) {
                                return date('d-m-Y', strtotime($user->dob));
                            })
                            ->addColumn('main_school', function(User $user) {
                                return $user->student->main_school;
                            })
                            ->addColumn('main_class', function(User $user) {
                                return $user->student->main_class;
                            })
                            ->addColumn('centre', function(User $user) {
                                return $user->student->centres->name;
                            })
                            ->addColumn('class', function(User $user) {
                                return $user->student->studentclasses->name;
                            })
                            ->addColumn('no_of_attended_classes', function(User $user) use ($start, $end) {

                                return Attendance::classAttendCount($start, $end, $user->id)['total'];
                            })
                            ->addColumn('percentage', function(User $user) use ($start, $end) {

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
        if ($request->ajax()) {
            $data = $request->all();
            $query = User::whereRole(User::STUDENT);
            if (isset($data['inactive'])) {
                $status = '0';
            } else {
                $status = '1';
            }
            if (!empty($data['student_name']) && !empty($data['year']) && !isset($data['not_paid'])) {
                $name = $data['student_name'];
                $year = $data['year'];
                $term = $data['term'];
                $centre = $data['centre'];
                $class = $data['classe'];
                if (is_numeric($name)) {
                    $ids = StudentDetail::where('centre', $centre)->where('classes', $class)->pluck('user_id')->all();
                    $query = User::whereIn('id', $ids);
                    $query->whereHas('fees', function ($q) use ($year, $term) {
                        $q->where('pay_year', $year);
                        $q->where('pay_term', $term);
                    })->where(['id' => $name, 'status' => $status]);
                } else {
                    $ids = StudentDetail::where('centre', $centre)->where('classes', $class)->pluck('user_id')->all();
                    $query = User::whereIn('id', $ids);
                    $query->whereHas('fees', function ($q) use ($year, $term) {
                                $q->where('pay_year', $year);
                                $q->where('pay_term', $term);
                            })
                            ->where('name', 'LIKE', '%' . $name . '%')
                            ->orWhereHas('student', function ($q) use ($name, $centre) {
                                $q->where('p1_first_name', 'LIKE', '%' . $name . '%');
                                $q->orWhere('p1_last_name', 'LIKE', '%' . $name . '%');
                            })->where('status', $status);
                }
            } elseif (empty($data['student_name']) && empty($data['year']) && isset($data['not_paid'])) {
                $year = date('Y');
                $centre = $data['centre'];
                $class = $data['classe'];
                $ids = StudentDetail::where('centre', $centre)->where('classes', $class)->pluck('user_id')->all();
                $query = User::whereIn('id', $ids);
                $query->whereDoesntHave('fees', function ($q) use ($year) {
                    $q->where('pay_year', $year);
                    $q->where('pay_term', Quarter::previousTerm());
                })->where(['status' => $status]);
            } elseif (empty($data['student_name']) && !empty($data['year']) && !isset($data['not_paid'])) {
                $year = $data['year'];
                $term = $data['term'];
                $centre = $data['centre'];
                $class = $data['classe'];
                $ids = StudentDetail::where('centre', $centre)->where('classes', $class)->pluck('user_id')->all();
                $query = User::whereIn('id', $ids);
                $query->whereHas('fees', function ($q) use ($year, $term) {
                    $q->where('pay_year', $year);
                    $q->where('pay_term', $term);
                })->where(['status' => $status]);
            } else {
                $centre = $data['centre'];
                $class = $data['classe'];
                $year = date('Y');
                $term = $data['term'];
                $ids = StudentDetail::where('centre', $centre)->where('classes', $class)->pluck('user_id')->all();
                $query = User::whereIn('id', $ids);
                $query->whereHas('fees', function ($q) use ($year, $term) {
                    $q->where('pay_year', $year);
                    $q->where('pay_term', $term);
                })->where(['status' => $status]);
            }
            return DataTables::of($query->get())
                            ->addColumn('date', function(User $user) {
                                $res = (!empty($user->fees)) ? date('d-m-Y', strtotime($user->fees->created_at)) : '';
                                return $res;
                            })
                            ->addColumn('student_name', function(User $user) {
                                return $user->name;
                            })
                            ->addColumn('parent_email', function(User $user) {
                                return $user->student->p1_email;
                            })
                            ->addColumn('invoice_type', function(User $user) {
                                $res = (!empty($user->fees)) ? $user->fees->invoice_type : '';
                                return $res;
                            })
                            ->addColumn('payment_details', function(User $user) {
                                return (!empty($user->fees)) ? '<strong>Year : </strong>' . $user->fees->pay_year . ' <strong>Term : </strong>' . $user->fees->pay_term : '';
                            })
                            ->addColumn('actions', function(User $user) {
                                return (!empty($user->fees)) ? '<a class="btn btn-sm btn-primary" href="invoice/' . $user->fees->id . '">Download Invoice</a> <a class="btn btn-sm btn-purple mail_invoice" href="mail-invoice/' . $user->fees->id . '">Send Invoice</a>' : '';
                            })->addIndexColumn()->rawColumns(['actions', 'payment_details'])->make(true);
        }
        $quarters = Quarter::get();
        $centres = Centre::get();
        $classes = ClassModel::get();
        return view('reports.payment', compact('quarters', 'classes', 'centres'));
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
        Mail::send('emails.invoice', ['payment' => $payment, 'users' => $users], function($message)use($payment, $pdf) {
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

}
