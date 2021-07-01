<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\LoginRecord;
use App\Models\Holiday;
use App\Models\Setting;
use App\Models\User;

class StudentLoginController extends Controller {

    public function __construct() {
        $this->middleware('guest')->except('logout', 'login', 'autologout', 'studentLoginTable');
    }

    public function index() {
        $auth = Setting::select('settings')->where('name', 'portal_login')->first();
        return view('auth.login', compact('auth'));
    }

    public function login(Request $request) {
        $userid = Crypt::decryptString($request->crypt_data);
        $res = LoginRecord::loginLogoutResponse($userid);
        return $res;
    }

    public function autologout() {
        $user = auth()->user();
        Auth::loginUsingId($user->id);
        return redirect('/');
    }

    function validatePhoneNumber(Request $request) {
        if (Setting::checkClassTime($request->current_desktop_timestamp) == 'time') {
            return redirect()->back()->with('error', 'You cannot login at this time.');
        }
        $holiday = Holiday::where('year', date('Y'))->first();
        $holidaysArr = explode(',', rtrim($holiday->holiday['holidays'], ','));
        if (in_array(date('Y-m-d'), $holidaysArr)) {
            return redirect()->back()->with('error', 'You cannot login today. Today is holiday.');
        }
        $user = StudentDetail::where('p1_mobile', $request->mobile)->orWhere('p2_mobile', $request->mobile)->first();
        if ($user) {
            return redirect("pin/$request->mobile");
        }
        return redirect()->back()->with('error', 'Entered mobile number is not associated with any student.');
    }

    function pin($parent_mobile_number) {
        $dataArr['parent_mobile_number'] = $parent_mobile_number;
        return view('auth/pin/pin', $dataArr);
    }

    function attemptParentLogin(Request $request) {
        $idsArr = StudentDetail::where('p1_mobile', $request->phone_number)->pluck('user_id')->all();
        $assignedArr = StudentDetail::where('p1_mobile', $request->phone_number)->pluck('assigned_kids')->first();
        if (!empty($assignedArr)) {
            $idsArr = array_merge($idsArr, $assignedArr);
        }
        $studentArr = User::whereIn('id', $idsArr)->where('pin', $request->pin)->first();
        if (!empty($studentArr->id)) {
            Auth::loginUsingId($studentArr->id);
            return redirect('student-login-table')->with('success', 'Parent logged in successfully');
        }
        return redirect()->back()->with('error', 'Incorrect pin or pin not generated');
    }

    function studentLoginTable() {
        $ids = StudentDetail::where('p1_mobile', Auth::user()->student->p1_mobile)->pluck('user_id')->all();
        $assigned = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('assigned_kids')->first();
        if (!empty($assigned)) {
            $ids = array_merge($ids, $assigned);
        }
        $dataArr['students'] = User::whereIn('id', $ids)->get();
        return view('students/student_login_table', $dataArr);
    }

    function changePin($phone_number) {
        pr($phone_number);
    }

}
