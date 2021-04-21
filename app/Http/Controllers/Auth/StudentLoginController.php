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

class StudentLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'studentLogin', 'findStudent', 'login', 'autologout');
    }

    public function index()
    {
        $auth = Setting::select('settings')->where('name', 'portal_login')->first();
        return view('auth.login', compact('auth'));
    }

    public function findParentMobile(Request $request)
    {
        if (Setting::checkClassTime() == 'time') {
            return 'time';
        }
        $holiday = Holiday::where('year', date('Y'))->first();
        $arr = explode(',', rtrim($holiday->holiday['holidays'], ','));
        if (in_array(date('Y-m-d'), $arr)) {
            return 'holiday';
        }
        $user = StudentDetail::where('p1_mobile', $request->mobile)
            ->orWhere('p2_mobile', $request->mobile)
            ->first();
        if ($user) {
            // Auth::login($user->user);
            return $request->mobile;
        }
        return false;
    }

    public function studentLogin()
    {
        $ids = LoginRecord::where('parent_mobile', auth()->user()->student->p1_mobile)->whereDate('login_time', date('Y-m-d'))->whereNull('logout_time')->pluck('user_id')->all();
        $assigned = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('assigned_kids')->first();
        if (!empty($assigned)) {
            $toArray = explode(",", $assigned);
            $parent_mob = StudentDetail::whereIn('user_id', $toArray)->first();
            $ids1 = LoginRecord::where('parent_mobile', $parent_mob->p1_mobile)->whereDate('login_time', date('Y-m-d'))->whereNull('logout_time')->pluck('user_id')->all();
            $ids = array_merge($ids, $ids1);
        }
        $students = User::whereIn('id', $ids)->get();
        return view('auth.loginWithPin', compact('students'));
    }

    public function findStudent(Request $request)
    {
        $ids = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('user_id')->all();
        $assigned = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('assigned_kids')->first();
        if (!empty($assigned)) {
            $ids = array_merge($ids, $assigned);
        }
        $students = User::whereIn('id', $ids)->where('pin', $request->pin)->get();
        if (count($students) < 1) {
            return false;
        }
        $students = User::whereIn('id', $ids)->get();
        return view('partials.user_list', compact('students'));
    }

    public function login(Request $request)
    {
        $userid = Crypt::decryptString($request->crypt_data);
        $res = LoginRecord::loginLogoutResponse($userid);
        return $res;
    }

    public function autologout()
    {
        $user = auth()->user();
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
}
