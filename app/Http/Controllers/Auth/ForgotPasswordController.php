<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\StudentDetail;
use App\Models\User;
use Hash;
use Mail;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function sendLink(Request $request){

       $user = User::where('email', $request->email)->first();

        if(empty($user)){
            session()->flash('error','Email address not exist.');
            return redirect()->back();
        }
        
        DB::table('pin_reset')->where('email', $request->email)->delete();

        $email = $request->email;

        DB::table('pin_reset')->insert([
            'email' => $request->email,
            'token' => Str::random(60) 
        ]);

        $tokenData = DB::table('pin_reset')->where('email', $request->email)->first();
        
        Mail::send('emails.reset_link', ['user'=> $user,'data' => $tokenData ], function($message)use($user,$email) {
            $message->to($email,'Admin')
            ->subject('BK - Reset Password');
        });

        return redirect()->route('admin.sentmail');



        }

    public function resentLink(Request $request) {

        return view('auth.passwords.sent_email');
    }

    public function resetFrom(Request $request) {

        $tokenData = DB::table('pin_reset')->where('token', $request->token)->first();

        if(!$tokenData){

            return abort('403','Token Expired');
        }


        $token = $tokenData->token;
    
        return view('auth.passwords.reset',compact('token'));
    }

     public function updatePassword(Request $request, $token) {

        $request->validate([

              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required',

        ]);



        $tokenData = DB::table('pin_reset')->where('token', $token)->first();
 
        if(!$tokenData){

            return abort('403','Token Expired');
        }

        $user = User::where('email', $tokenData->email)
                ->update(['password' => Hash::make($request->password)]);

        DB::table('pin_reset')->where(['email'=> $tokenData->email])->delete();

        session()->flash('success','Password Updated Sucessfully.');
        
        return redirect('/admin/login');
    }
}
