<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes as ClassModel;
use App\Models\Centre;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller {

    function index(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            if (empty($data['centre']) && empty($data['classes'])) {
                return [];
            }
            $centre = $request->centre;
            $class = $request->classes;
            if (isset($request->date)) {
                $date = $request->date;
            } else {
                $date = '';
            }
            $users = User::whereRole(User::STUDENT)->whereHas('student', function($q) use($centre, $class) {
                        $q->where('centre', '=', $centre);
                        $q->where('classes', '=', $class);
                    })->get();
            return view('attendance._attendance_table', compact('users', 'centre', 'date', 'class'));
        }
        $classes = ClassModel::get();
        $centres = Centre::get();
        return view('attendance.index', compact('classes', 'centres'));
    }

    function markAttend(Request $request) {
        if ($request->isMark == 1) {
            $attendance = new Attendance();
            $attendance->user_id = $request->student;
            $attendance->centre_id = $request->centre;
            $attendance->classes_id = $request->classes;
            $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
            $attendance->attendance_by = auth()->user()->id;
            $attendance->save();
        } else {
            Attendance::where('user_id', $request->student)->whereDate('attendance_date', $request->date)->delete();
        }
        return true;
    }

    function showStudentList(Request $request) {
        $centre = $request->centre;
        $class = $request->classes;
        $users = User::whereHas('student', function($q) use($centre) {
                    $q->where('centre', '=', $centre);
                })->whereHas('classes', function($q) use($class) {
                    $q->where('classes_id', '=', $class);
                })->get();
        return view('attendance.mark_attand', compact('users'));
    }

}
