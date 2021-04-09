<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function setting(){

    	return view('profile.setting');
    }

    public function profile(){

    	return view('profile.profile');
    }

    public function changePassword(Request $request){



    	$request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

    	session()->flash('success','Password Changed !');

    	return redirect()->back();
    }

    public function profileUpdate(Request $request){



    	$user = User::find(auth()->user()->id);
    	$user->name = $request->first_name.' '.$request->last_name;
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->email = $request->email;
    	$user->save();

    	session()->flash('success','Profile Updated !');

    	return redirect()->back();
    }
}
