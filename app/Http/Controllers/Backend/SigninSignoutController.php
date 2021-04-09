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

class SigninSignoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){

        // echo "<pre>";
        // print_r($request->all());
        // die;

            $query = LoginRecord::query();

            if(!empty($request->centre) && !empty($request->class)  && empty($request->start_date) && empty($request->end)){
                 
               $ids = StudentDetail::where('centre',$request->centre)->where('classes',$request->class)->pluck('user_id')->all();
               $query = $query->whereIn('user_id',$ids);
            }elseif(!empty($request->centre) && !empty($request->class)  && !empty($request->start_date) && !empty($request->end_date)){
               
               $start = date('Y-m-d',strtotime($request->start_date));
               $end = date('Y-m-d',strtotime($request->end_date));
               $ids = StudentDetail::where('centre',$request->centre)->where('classes',$request->class)->pluck('user_id')->all();
               $query = $query->whereIn('user_id',$ids)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end);

            }
    
            return DataTables::eloquent($query)
                        ->addColumn('date', function (LoginRecord $user) {
                            return date('d-m-Y',strtotime($user->created_at));
                        })
                        ->addColumn('name', function (LoginRecord $user) {
                            return $user->user->name;
                        })
                        ->addColumn('class', function (LoginRecord $user) {
                            return $user->user->student->studentclasses->name;
                        })

                        ->addColumn('login_time', function (LoginRecord $user) {
                            return date('h:i A', strtotime($user->login_time));
                        })

                        ->addColumn('logout_time', function (LoginRecord $user) {
                            return date('h:i A', strtotime($user->logout_time));
                        })

                        ->addColumn('duration', function (LoginRecord $user) {
                        	$to = Carbon::createFromFormat('Y-m-d H:i:s', $user->logout_time);
							$from = Carbon::createFromFormat('Y-m-d H:i:s', $user->login_time);
							$min = floor(($to->diffInSeconds($from)/60));

							$hours = floor($min / 60);
                            $min = $min - ($hours * 60);
							return $hours." Hours ".$min." Minutes";
                        })
                        
                        // ->addColumn('actions', function(LoginRecord $user) {
                        //     return '<a class="btn btn-sm btn-primary" href="teacher/edit/'.$user->id.'"><i class="fa fa-edit"></i></a> <a  class="btn btn-sm btn-primary" href="teacher/show/'.$user->id.'"><i class="glyphicon glyphicon-eye-open" title="View"></i></a>';
                        // })
                        ->addIndexColumn()->rawColumns(['actions'])->make(true);
        }

        $centres = Centre::get();
        $classes = Classes::get();

        return view('students.sign_in',compact('centres','classes'));
    }

    public function signinSignout()
    {
        return view('students.signin_signout');
    }

    public function loadForSigninOut(Request $request)
    {


        $parent = $request->parent_number;

        $ids =  StudentDetail::where('p1_mobile', $parent)->pluck('user_id')->all();

        $assigned = StudentDetail::where('p1_mobile', $parent)->pluck('assigned_kids')->first();

        if(!empty($assigned)){

            $toArray = explode(",", $assigned);

           $ids = array_merge($ids,$toArray);

        }


        $students = User::whereIn('id',$ids)->get();


       return view('partials.load_kids_signin_signout', compact('students'));

       
    }

}
