<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as ClassModel;
use App\Models\Centre;
use App\Models\Attendance;
use App\Models\StudentDetail;
use App\Models\User;
use DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       
       if($request->ajax()){

        $data = $request->all();

        // echo "<pre>";
        // print_r($data);
        // die;

        if(empty($data['centre']) && empty($data['classes'])){

            return [];

        }

        $centre = $request->centre;

        $class = $request->classes;

        if(isset($request->date)){
           $date = $request->date;
            

        }else{
        $date = '';
        
        }

         $users = User::whereRole(User::STUDENT)->whereHas('student', function($q) use($centre,$class) {

                   $q->where('centre', '=', $centre);
                   $q->where('classes', '=', $class);

            })->get();
        
        return view('attendance._attendance_table', compact('users','centre','date','class'));
        
        }

       $classes = ClassModel::get();
       $centres = Centre::get();
       return view('attendance.index',compact('classes','centres'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAttend(Request $request)
    {
        
        if($request->isMark == 1){

            $attendance = new Attendance();
            $attendance->user_id = $request->student;
            $attendance->centre_id = $request->centre;
            $attendance->classes_id = $request->classes;
            $attendance->attendance_date = date('Y-m-d',strtotime($request->date));
            $attendance->attendance_by = auth()->user()->id;
            $attendance->save();

        }else{

            Attendance::where('user_id',$request->student)->whereDate('attendance_date', $request->date)->delete();

        }

        return true;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        die('here');
    }

    public function showStudentList(Request $request)
    {

        $centre = $request->centre;

        $class = $request->classes;

        $users = User::whereHas('student', function($q) use($centre) {
                       $q->where('centre', '=', $centre);
                })->whereHas('classes', function($q) use($class) {
                       $q->where('classes_id', '=', $class);
                })->get();

        return view('attendance.mark_attand', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
