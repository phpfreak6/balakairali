<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth; 

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        
        $this->validate($request, [
            'email'           => 'required|max:255|email',
            'password'           => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
      
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if(Auth::user()->isAdmin()){
                return redirect(RouteServiceProvider::ADMIN);
            }elseif(Auth::user()->isTeacher()){
                return redirect(RouteServiceProvider::ADMIN);
            }else{
                return redirect(RouteServiceProvider::HOME);
            }
        }else{
                session()->flash('error','credentials not mathing.');
                return redirect()->back();
        }
    }
    // public function redirectPath()  
    // {   

    //    $user = auth()->user();
    //    $role = $user->roles->first()->title;
            
    // }
}
