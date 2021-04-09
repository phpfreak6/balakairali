<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentDetail;
use Carbon\Carbon;

class LoginRecord extends Model
{
    use HasFactory;

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public static function loginLogoutResponse($userid){


        $user = User::find($userid);
        
        if($user->status == '0'){

            return response()->json(['status' => 'inactive','id' => $userid, 'text' => 'Sign-in']);
        }

    	$record = self::where('user_id', $userid)->whereDate('login_time',date('Y-m-d'))->first();

        
        if(!empty($record->logout_time)){
            
            return response()->json(['status' => 'logout','id' => $userid, 'text' => 'Sign-in']);

        }

        if($record){

            $record->logout_time = Carbon::now();
            $record->save();
            
            $checkLogin = self::checkLogin();

            if($checkLogin == true){
                
               
            	return response()->json(['status' => 'logged-out','logout' => true,'id' => $userid, 'text' => 'Sign-in']);

            }

            return response()->json(['status' => 'logged-out','logout' => false, 'id' => $userid, 'text' => 'Sign-in']);

        }else{

            $student = StudentDetail::where('user_id',$userid)->first();
            $record = new self();
            $record->user_id = $userid;
            $record->parent_mobile = $student->p1_mobile;
            $record->login_time = Carbon::now();
            $record->save();

            if(self::leftLogin() == true){

                return response()->json(['status' => '','logout' => true,'id' => $userid, 'text' => 'Sign-in']);
            }

            return response()->json(['status' => '','logout' => false, 'id' => $userid, 'text' => 'Sign-out']);
        }
    }

    public static function checkLogin(){

    	$ids =  StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('user_id')->all();

         $assigned = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('assigned_kids')->first();

        if(!empty($assigned)){

            $toArray = explode(",", $assigned);

           $ids = array_merge($ids,$toArray);

        }
        
    	$logout = self::whereIn('user_id',$ids)->whereDate('login_time',date('Y-m-d'))->whereNull('logout_time')->count();
        
        if($logout > 0){

        	return false;

        }else{

            return true;

        }
        
    }

    public static function leftLogin(){

        $ids =  StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('user_id')->all();

         $assigned = StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->pluck('assigned_kids')->first();

        if(!empty($assigned)){

            $toArray = explode(",", $assigned);

           $ids = array_merge($ids,$toArray);

        }

        $count = count($ids);
        
        $logout = self::whereIn('user_id',$ids)->whereDate('login_time',date('Y-m-d'))->count();
        
        if($logout == $count){

            return true;

        }else{

            return false;

        }
    }

    public static function childCount(){

        return StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->count();
    }
}
