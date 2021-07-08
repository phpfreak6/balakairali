<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use Illuminate\Http\Request;
use App\Models\Classes as ClassModel;
use App\Models\Centre;
use App\Models\StudentDetail;
use App\Models\User;
use DataTables;

class ClassesController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $query = ClassModel::query();
            if (!empty($request->centre)) {
                $centre = $request->centre;
                $query->where('centre_id', $centre);
            }

            return DataTables::of($query->get())
                            ->addColumn('centre_name', function(ClassModel $class) {
                                return ($class->centre) ? $class->centre->name : '';
                            })
                            ->addColumn('actions', function(ClassModel $class) {
                                if (User::hasPermission('editing_teacher')) {
                                    return '<a class="btn btn-sm btn-primary" href="class/edit/' . $class->id . '"><i class="fa fa-edit"></i></a> <a onclick="return confirm(\'Are you sure you want to delete this class?\')" class="btn btn-sm btn-danger" href="class/delete/' . $class->id . '"><i class="fa fa-trash"></i></a>';
                                } else {
                                    return '';
                                }
                            })->addIndexColumn()->rawColumns(['actions'])->make(true);
        }
        $centres = Centre::get();
        return view('classes.list', compact('centres'));
    }

    public function create() {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $centres = Centre::get();
        return view('classes.create', compact('centres'));
    }

    public function store(StoreClassRequest $request) {
        $store = new ClassModel();
        $store->centre_id = $request->centre;
        $store->name = $request->name;
        $store->save();
        if ($store) {
            session()->flash('success', 'Class Created Successfully');
        } else {
            session()->flash('error', 'Something Went Wrong.');
        }
        return redirect()->route('admin.classes');
    }

    public function edit($id) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        $class = ClassModel::find($id);
        $centres = Centre::get();
        return view('classes.edit', compact('class', 'centres'));
    }

    public function update(UpdateClassRequest $request, $id) {
        $update = ClassModel::find($id);
        $update->centre_id = $request->centre;
        $update->name = $request->name;
        $update->save();
        session()->flash('success', 'Class Updated Successfully');
        return redirect()->route('admin.classes');
    }

    public function destroy($id) {
        if (User::hasPermission('accessing_teacher')) {
            return abort('403', 'You cannot access this route.');
        }
        ClassModel::find($id)->delete();
        session()->flash('success', 'Class Deleted Successfully');
        return redirect()->back();
    }

    public function loadClasses(Request $request) {
        if (empty($request->centre)) {
            $classes = ClassModel::get();
        } else {
            $classes = ClassModel::where('centre_id', $request->centre)->get();
        }
        return view('partials.load_classes', compact('classes'));
    }

    public function loadEditClasses(Request $request, $user_id) {
        $class_id = StudentDetail::where('user_id', $user_id)->first()->classes;
        $classes = ClassModel::where('centre_id', $request->centre)->get();
        return view('partials.load_classes', compact('classes', 'class_id'));
    }

}
