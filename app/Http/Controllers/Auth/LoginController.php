<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('auth.admin_login');
    }

    public function login(Request $request) {
        $this->validate($request, ['email' => 'required|max:255|email', 'password' => 'required']);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->isAdmin()) {
                return redirect(RouteServiceProvider::ADMIN);
            } elseif (Auth::user()->isTeacher()) {
                return redirect(RouteServiceProvider::ADMIN);
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        } else {
            session()->flash('error', 'credentials not mathing.');
            return redirect()->back();
        }
    }

    protected function loggedOut(Request $request) {
        if (!empty($request->flash_message)) {
            Session::flash('success', $request->flash_message);
        }
        Auth::logout();
        return redirect('login');
    }

}
