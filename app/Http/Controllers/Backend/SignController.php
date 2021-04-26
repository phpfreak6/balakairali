<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginRecord;
use App\Models\StudentDetail;
use App\Models\Centre;
use App\Models\User;
use App\Models\Classes;
use Carbon\Carbon;
use DataTables;
use DB;

class SignController extends Controller {

    public function index(Request $request) {
        if ($request->isMethod('post')) {
            $query = DB::table('login_records')
                    ->join('users', 'users.id', '=', 'login_records.user_id')
                    ->join('student_details', 'student_details.user_id', '=', 'login_records.user_id')
                    ->join('centres', 'centres.id', '=', 'student_details.centre')
                    ->join('classes', 'classes.id', '=', 'student_details.classes')
                    ->select('login_records.*', 'users.name as user_name', 'centres.name as center_name', 'classes.name as class_name');
            !empty($request->centre) ? $query->where('student_details.centre', '=', $request->centre) : '';
            !empty($request->class) ? $query->where('student_details.classes', '=', $request->class) : '';
            !empty($request->start_date) && !empty($request->end_date) ?
                            $query->whereBetween('login_records.created_at', [
                                date('Y-m-d', strtotime($request->start_date)),
                                date('Y-m-d', strtotime($request->end_date))
                            ]) : '';
            $resultArr = $query->get();
            return DataTables::of($resultArr)
                            ->addColumn('date', function ($query) {
                                return date('d-m-Y', strtotime($query->created_at));
                            })
                            ->addColumn('login_time', function ($query) {
                                if (!empty($query->login_time)) {
                                    return date('h:i A', strtotime($query->login_time));
                                }
                                return 'N/A';
                            })
                            ->addColumn('logout_time', function ($query) {
                                if (!empty($query->logout_time)) {
                                    return date('h:i A', strtotime($query->logout_time));
                                }
                                return 'N/A';
                            })
                            ->addColumn('duration', function ($query) {
                                if (!empty($query->login_time) && !empty($query->logout_time)) {
                                    $to = Carbon::createFromFormat('Y-m-d H:i:s', $query->logout_time);
                                    $from = Carbon::createFromFormat('Y-m-d H:i:s', $query->login_time);
                                    $min = floor(($to->diffInSeconds($from) / 60));
                                    $hours = floor($min / 60);
                                    $min = $min - ($hours * 60);
                                    return $hours . " Hours " . $min . " Minutes";
                                }
                                return 'N/A';
                            })
                            ->addIndexColumn()
                            ->make(true);
        }
        $dataArr['centres'] = Centre::get();
        $dataArr['classes'] = Classes::get();
        return view('students/sign_in', $dataArr);
    }

    public function signinSignout() {
        return view('students.signin_signout');
    }

    public function loadForSigninOut(Request $request) {
        $parent = $request->parent_number;
        $ids = StudentDetail::where('p1_mobile', $parent)->pluck('user_id')->all();
        $assigned = StudentDetail::where('p1_mobile', $parent)->pluck('assigned_kids')->first();
        if (!empty($assigned)) {
            $toArray = explode(",", $assigned);
            $ids = array_merge($ids, $toArray);
        }
        $students = User::whereIn('id', $ids)->get();
        return view('partials.load_kids_signin_signout', compact('students'));
    }

}