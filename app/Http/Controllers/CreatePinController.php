<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\StudentDetail;
use App\Models\User;
use Mail;
use DB;

class CreatePinController extends Controller
{

    public function createPin(Request $request)
    {
        $type = last(request()->segments());
        if (!empty(auth()->user()->pin) && ($type == 'create-pin')) {
            session()->flash('error', 'Pin already created. You can reset your pin.');
            return redirect()->back();
        }
        session()->put('type', $type);
        return view('auth/pin/create_pin');
    }

    public function sendOtp(Request $request)
    {
        $user = StudentDetail::where('p1_email', $request->email)->first();
        if (empty($user)) {
            session()->flash('error', 'Email address does not exist.');
            return redirect()->back();
        }

        DB::table('pin_reset')->where('email', $request->email)->delete();

        $otp = rand(100000, 999999);
        $email = $request->email;
        DB::table('pin_reset')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'token' => Str::random(60)
        ]);

        $tokenData = DB::table('pin_reset')->where('email', $request->email)->first();
        Mail::send('emails.pin_otp', ['user' => $user, 'otp' => $otp], function ($message) use ($user, $email) {
            $message->to($email, 'Parent')->subject('Balakairali - One Time Password');
        });
        session()->flash('success', 'OTP sent successfully. Please check your email.');
        return redirect()->route('confirmOtp', ['token' => $tokenData->token]);
    }

    public function confirmOtp(Request $request)
    {
        $tokenData = DB::table('pin_reset')->where('token', $request->token)->first();
        if (!$tokenData) {
            session()->flash('error', 'Your token expired. Please try again.');
            if (session()->get('type') == 'forgot-pin') {
                return redirect('/forgot-pin');
            }
            return redirect('/create-pin');
        }
        $token = $request->token;
        return view('auth.pin.otp', compact('token'));
    }

    public function matchOtp(Request $request, $token)
    {
        $validated = $request->validate(['otp' => 'required']);

        $tokenData = DB::table('pin_reset')->where('token', $token)->first();

        if (!$tokenData) {
            session()->flash('error', 'Your token expired. Please try again.');
            return redirect('/create-pin');
        }

        if ($tokenData->otp != $request->otp) {
            session()->flash('error', 'OTP is incorrect');
            return redirect()->back();
        }
        DB::table('pin_reset')->where('email', $tokenData->email)->update(['token' => Str::random(60)]);
        $tokenData = DB::table('pin_reset')->where('email', $tokenData->email)->first();
        return redirect('reset-pin/' . $tokenData->token);
    }

    public function resetPinForm($token)
    {
        $tokenData = DB::table('pin_reset')->where('token', $token)->first();
        if (!$tokenData) {
            session()->flash('error', 'Your token expired.');
            return redirect('/create-pin');
        }
        return view('auth.pin.reset_pin', compact('token'));
    }

    public function resetPin(Request $request, $token)
    {
        $tokenData = DB::table('pin_reset')->where('token', $token)->first();
        if (!$tokenData) {
            return redirect('create-pin')->with('error', 'Your token is expired.');
        }
        $validated = $request->validate(['new_pin' => 'required|numeric|digits:4', 'confirm_pin' => 'required|same:new_pin']);
        $userids = StudentDetail::where('p1_email', $tokenData->email)->pluck('user_id')->all();
        User::whereIn('id', $userids)->update(['pin' => $request->new_pin]);
        DB::table('pin_reset')->where('token', $token)->delete();
        return redirect('/')->with('success', 'Pin changed successfully');
    }
}
