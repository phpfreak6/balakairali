<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDetail;

class AssignController extends Controller {

    public function assignKids($number) {
        $checkAssignedOther = StudentDetail::checkAssigned($number);
        $students = StudentDetail::where('p1_mobile', $number)->get();
        return view('assign.assign', compact('students', 'number', 'checkAssignedOther'));
    }

    public function loadList(Request $request) {
        if ($request->main_parent == $request->another_parent) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong !']);
        }
        $numberOrName = $request->another_parent;
        if (is_numeric($numberOrName)) {
            $parents = StudentDetail::select('p1_first_name', 'p1_last_name', 'p1_mobile')
                    ->where('p1_mobile', $numberOrName)
                    ->groupByRaw('p1_first_name, p1_last_name, p1_mobile')
                    ->get();
        } else {
            $numberOrNameArr = explode(' ', $numberOrName);
            $parents = StudentDetail::select('p1_first_name', 'p1_last_name', 'p1_mobile')
                    ->where(function ($query) use ($numberOrNameArr) {
                        foreach ($numberOrNameArr as $value) {
                            $query->orWhere('p1_first_name', 'like', "%{$value}%");
                        }
                    })
                    ->orWhere(function ($query) use ($numberOrNameArr) {
                        foreach ($numberOrNameArr as $val) {
                            $query->orWhere('p1_last_name', 'like', "%{$val}%");
                        }
                    })
                    ->groupByRaw('p1_first_name, p1_last_name, p1_mobile')
                    ->get();
        }
        if (count($parents) < 1) {
            return response()->json(['status' => false, 'message' => 'Parent not exist.']);
        }
        return view('partials.parent_list', compact('parents'));
    }

    public function assign(Request $request) {
        if ($request->assignTo == $request->parent_number) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong !']);
        }
        $students = StudentDetail::where('p1_mobile', $request->assignTo)->get();
        if (count($students) < 1) {
            return response()->json(['status' => false, 'message' => 'Another Parent mobile number did not match.']);
        }
        $students = StudentDetail::where('p1_mobile', $request->parent_number)->pluck('user_id')->all();
        $check = StudentDetail::where('p1_mobile', $request->assignTo)->where('assigned_kids', '!=', NULL)->first();
        if (!empty($check)) {
            return response()->json(['status' => false, 'message' => 'Already assigned kids to this parent.']);
        }
        $s_date = implode(",", $students);
        StudentDetail::where('p1_mobile', $request->assignTo)->update(['assigned_kids' => $s_date]);
        return response()->json(['status' => true, 'message' => 'Kid/s Assigned Successfully']);
    }

    public function unassign(Request $request) {
        $check = StudentDetail::where('p1_mobile', $request->assignTo)->update(['assigned_kids' => NULL]);
        return response()->json(['status' => true, 'message' => 'Kid/s Un-Assigned Successfully']);
    }

}
