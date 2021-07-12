<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Classes as ClassModel;
use App\Models\LoginRecord;
use App\Models\Quarter;
use App\Models\Centre;
use App\Models\StudentDetail;
use App\Models\InvoiceSetting;
use App\Models\Mark;
use App\Models\User;
use App\Models\Fee;
use Carbon\Carbon;
use DataTables;
use PDF;
use DB;

class StudentsController extends Controller {

    function index(Request $request) {
        if ($request->ajax()) {
            $query = User::whereRole(User::STUDENT);
            if (in_array($request->status, [STATUS_INACTIVE, STATUS_ACTIVE])) {
                $query->where('status', '=', $request->status);
            }
            $class = (!isset($request->classe) || empty($request->classe)) ? '' : $request->classe;
            if (!empty($class) && empty($request->centre)) {
                $class = $request->classe;
                $query->whereHas('student', function($q) use($class) {
                    $q->where('classes', $class);
                });
            } elseif (empty($class) && !empty($request->centre)) {
                $centre = $request->centre;
                $query->whereHas('student', function($q) use($centre) {
                    $q->where('centre', $centre);
                });
            } elseif (!empty($class) && !empty($request->centre)) {
                $centre = $request->centre;
                $query->whereHas('student', function($q) use($centre, $class) {
                    $q->where('centre', $centre);
                    $q->where('classes', $class);
                });
            }
            return DataTables::eloquent($query)
                            ->addColumn('classes', function (User $user) {
                                return !empty($user->student->studentclasses->name) ? $user->student->studentclasses->name : '';
                            })
                            ->addColumn('centre', function (User $user) {
                                return !empty($user->student->centres->name) ? $user->student->centres->name : '';
                            })
                            ->addColumn('parent1', function (User $user) {
                                return !empty($user->student->p1_first_name) ? $user->student->p1_first_name . ' ' . $user->student->p1_last_name : '';
                            })
                            ->addColumn('p1_mobile', function (User $user) {
                                return !empty($user->student->p1_mobile) ? $user->student->p1_mobile : '';
                                return $user->student->p1_mobile;
                            })
                            ->addColumn('status', function (User $user) {
                                if ($user->status == 1) {
                                    return '<span class="label label-sm label-success">Active</span>';
                                } else {
                                    return '<span class="label label-sm label-danger">Inactive</span>';
                                }
                            })
                            ->addColumn('p1_email', function (User $user) {
                                return $user->student->p1_email;
                            })
                            ->addColumn('actions', function(User $user) {
                                if (User::hasPermission('editing_teacher')) {
                                    return '<button  class="btn btn-sm btn-success markaspaid" data-id="' . $user->id . '">Mark Paid</button> '
                                            . '<a  class="btn btn-sm btn-primary" href="student/assign/' . $user->student->p1_mobile . '">Assign</a> '
                                            . '<button type="button"  class="btn btn-sm btn-warning" onclick="showStudentSignInModal(' . $user->id . ')">Sign In</button> '
                                            . '<a  class="btn btn-sm btn-primary" href="student/edit/' . $user->id . '"><i class="fa fa-edit"></i></a> '
                                            . '<a  class="btn btn-sm btn-primary" href="student/show/' . $user->id . '"><i class="glyphicon glyphicon-eye-open" title="View"></i></a> '
                                            . '<a  onclick="return confirm(\'Are you sure you want to delete this student?\')" class="btn btn-sm btn-danger" href="student/delete/' . $user->id . '"><i class="fa fa-trash" title="Delete"></i></a>';
                                } else {
                                    return '<a  class="btn btn-sm btn-primary" href="student/show/' . $user->id . '"><i class="glyphicon glyphicon-eye-open" title="View"></i></a>';
                                }
                            })->addIndexColumn()->rawColumns(['actions', 'status'])->make(true);
        }
        $quarters = DB::table('quarters')->get();
        $types = InvoiceSetting::get();
        $centres = Centre::get();
        $classes = ClassModel::get();
        return view('students.list', compact('quarters', 'types', 'centres', 'classes'));
    }

    public function create() {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $classes = ClassModel::get();
        $centres = Centre::get();
        return view('students.create', compact('classes', 'centres'));
    }

    public function store(StoreStudentRequest $request) {
        $data = $request->all();
        $data['pin'] = $data['pin'];
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $user = User::create($data);
        $data['user_id'] = $user->id;
        StudentDetail::create($data);
        session()->flash('success', 'Student Registered Successfully');
        return redirect()->route('admin.students');
    }

    public function show($id) {
        $student = User::whereId($id)->first();
        $terms = Quarter::get();
        return view('students.show', compact('student', 'terms'));
    }

    public function edit($id) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $classes = ClassModel::get();
        $centres = Centre::get();
        $user = User::whereId($id)->first();
        return view('students.edit', compact('classes', 'centres', 'user'));
    }

    public function update(Request $request, $id) {
        $data = $request->except('_token');
        $user = User::find($id);
        $user->classes()->sync($data['classes']);
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        if (isset($data['pin']) && !empty($data['pin'])) {
            $user->pin = $data['pin'];
        }
        $user->name = $data['first_name'] . ' ' . $data['last_name'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->dob = $data['dob'];
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->postcode = $data['postcode'];
        $user->suburb = $data['suburb'];
        $user->state = $data['state'];
        $user->save();
        $detail = StudentDetail::where('user_id', $id)->first();
        $detail->centre = $data['centre'];
        $detail->classes = $data['classes'];
        $detail->p1_type = $request->p1_type;
        $detail->p1_first_name = $request->p1_first_name;
        $detail->p1_last_name = $request->p1_last_name;
        $detail->p1_email = $request->p1_email;
        $detail->p1_mobile = $request->p1_mobile;
        $detail->p2_type = ($request->p2_type) ? $request->p2_type : '';
        $detail->p2_first_name = ($request->p2_first_name ) ? $request->p2_first_name : '';
        $detail->p2_last_name = ($request->p2_last_name) ? $request->p2_last_name : '';
        $detail->p2_email = ($request->p2_email) ? $request->p2_email : '';
        $detail->p2_mobile = ($request->p2_mobile) ? $request->p2_mobile : '';
        $detail->remarks = $data['remarks'];
        $detail->e_person_name = $data['e_person_name'];
        $detail->e_person_phone = $data['e_person_phone'];
        $detail->e_person_email = $data['e_person_email'];
        $detail->main_school = $data['main_school'];
        $detail->main_class = $data['main_class'];
        $detail->save();
        session()->flash('success', 'Student Updated Successfully');
        return redirect()->route('admin.students');
    }

    public function destroy($id) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $user = User::find($id);
        $user->student()->delete();
        $user->delete();
        session()->flash('success', 'Student Deleted');
        return redirect()->route('admin.students');
    }

    public function accountStatus(Request $request) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $user = User::where('id', $request->user_id)->update(['status' => $request->status]);
        if (!$user) {
            return false;
        }
        return true;
    }

    public function markPaid(Request $request) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        if ($request->mPaidTerm == 'full_year') {
            $quartersObj = Quarter::all();
            foreach ($quartersObj as $quarterObj) {
                $result = Fee::where('user_id', $request->hidPayStdId)
                        ->where('pay_year', $request->mPaidYear)
                        ->where('pay_term', $quarterObj->id)
                        ->first();
                if (!$result) {
                    Fee::insert(['user_id' => $request->hidPayStdId, 'pay_year' => $request->mPaidYear, 'pay_term' => $quarterObj->id]);
                }
            }
            return true;
        }
        $paid = Fee::where('user_id', $request->hidPayStdId)->where('pay_year', $request->mPaidYear)->where('pay_term', $request->mPaidTerm)->first();
        if (!empty($paid)) {
            return response()->json(['status' => 'paid', 'msg' => 'Payment entry for student ID ' . $request->hidPayStdId . ' is already made for ' . $paid->pay_year . ' and ' . $paid->quarter->name . ' term.']);
        }
        $fee = new Fee();
        $fee->user_id = $request->hidPayStdId;
        $fee->pay_year = $request->mPaidYear;
        $fee->pay_term = $request->mPaidTerm;
        $fee->save();
        return true;
    }

    public function studentMarks(Request $request) {
        $student = User::find($request->user_id);
        $data = $request->all();
        $data['centre'] = $student->student->centre;
        $data['classes'] = $student->student->classes;
        $data['term'] = $this->numFormatter($request->term);
        $data['year'] = date('Y');
        $data['date_of_test'] = date('Y-m-d', strtotime($request->date_of_test));
        Mark::create($data);
        return true;
    }

    public function studentProgress(Request $request, $id) {
        $forterm = $this->numFormatter($request->p_term);
        $marks = Mark::where('user_id', $id)->whereTerm($forterm)->where('year', $request->p_year)->get();
        if (count($marks) < 1) {
            session()->flash('error', 'Data not found for selected Term and Year.');
            return redirect()->back();
        }
        $student = User::where('id', $id)->first();
        $studentDetailArr = StudentDetail::where('user_id', $id)->first();
        $term = $request->p_term;
        $pdf = PDF::loadView('students.pdf.progress', compact('marks', 'student', 'term', 'studentDetailArr'));
        return $pdf->download('student-progress.pdf');
    }

    public function numFormatter($term) {
        return (int) filter_var($term, FILTER_SANITIZE_NUMBER_INT);
    }

    public function loadClasses(Request $request) {
        if (empty($request->centre)) {
            $classes = ClassModel::get();
        } else {
            $classes = ClassModel::where('centre_id', $request->centre)->get();
        }
        return response()->json(['data' => $classes]);
    }

    public function studentSigninSignout(Request $request) {
        $student = StudentDetail::where('user_id', $request->student_id)->first();
        $add = LoginRecord::where('user_id', $request->student_id)->whereDate('created_at', date('Y-m-d'))->first();
        if (!empty($add->login_time) && !empty($add->logout_time)) {
            return response()->json(['status' => false, 'message' => 'Selected student accounts are logged out already or not logged in for today !']);
        }
        $action = $request->action;
        if ($action == 'Sign-in') {
            $add = new LoginRecord();
            $add->user_id = $request->student_id;
            $add->parent_mobile = $student->p1_mobile;
            $add->login_time = Carbon::now();
            $message = 'Student signed-in successfully';
            $html = 'Signed In';
            $btn_text = 'Sign-out';
        } else {
            $add->logout_time = Carbon::now();
            $message = 'Student signed-out successfully';
            $html = 'Signed Out';
            $btn_text = 'Sign-in';
        }
        $add->save();
        return response()->json(['status' => true, 'message' => $message, 'btn_text' => $btn_text, 'html' => $html, 'user_id' => $request->student_id]);
    }

    function signInStudent(Request $request) {
        $student_id = $request->student_id;
        $login_time = $request->login_time;
        $studentDetailObj = StudentDetail::where('user_id', $student_id)->first();
        $loginRecordArr = LoginRecord::where('user_id', $student_id)->whereDate('login_time', Carbon::parse($login_time)->format('Y-m-d'))->first();
        if (!empty($loginRecordArr->login_time)) {
            return redirect()->back()->with('error', "Student already logged in for the given date");
        } else {
            LoginRecord::insert([
                'user_id' => $student_id,
                'parent_mobile' => $studentDetailObj->p1_mobile,
                'login_time' => $login_time,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success', "Student marked as logged in for the given date");
        }
    }

    function signOutStudent(Request $request) {
        $login_record_id = $request->id;
        if (!empty(LoginRecord::where('id', '=', $login_record_id)->update(['logout_time' => $request->logout_time]))) {
            return redirect()->back()->with('success', "Student marked as logged out for the given date");
        }
        return redirect()->back()->with('error', "Student marking as logged out failed for the given date");
    }

    function showStudentSignInModal(Request $request) {
        $dataArr['studentObj'] = User::whereRole(User::STUDENT)->where('id', '=', $request->student_id)->first();
        return view('students/modals/StudentSignInModal', $dataArr);
    }

    function showStudentSignOutModal(Request $request) {
        $dataArr['record_id'] = $request->id;
        return view('students/modals/StudentSignOutModal', $dataArr);
    }

}
