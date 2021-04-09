<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Holiday;
use App\Models\User;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function settings(){

        if(User::hasPermission('accessing_teacher')){

         return abort('403','You cannot access this route.');
         
        }

    	$setting = Holiday::select('holiday')->where('year',date('Y'))->first();

        if(empty($setting)){
            
           $new = new Holiday();
           $new->year = date('Y');
           $new->holiday = ['holidays' => null];
           $new->save();
        }
        
        $settings = Holiday::select('holiday')->where('year',date('Y'))->first()->holiday;
        
    	$timing = Setting::select('settings')->where('name','class_time')->first()->settings;
        $email = Setting::where('name','admin_email')->first()->settings;
        $portal_login = Setting::where('name','portal_login')->first()->settings;
       
    	return view('settings.index',compact('settings','timing','email','portal_login'));
    }

    public function updateSettings(Request $request){

        Setting::where('name','admin_email')->update(['settings' => $request->email]);
        Setting::where('name','class_time')->update(['settings' => $request->setting]);
        Setting::where('name','portal_login')->update(['settings' => $request->login]);
        Holiday::where('year',date('Y'))->update(['holiday->holidays' => $request->holidays]);


        session()->flash('success','Settings updated successfully');
        
        return redirect()->back();

    }
}
