<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\Request;
use App\Models\TeacherCertification;
use App\Models\Classes as ClassModel;
use App\Models\Permission;
use App\Models\Centre;
use App\Models\User;
use DataTables;
use Mail;

class TeachersController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $query = User::whereRole(User::TEACHER);
            if (in_array($request->status, [STATUS_INACTIVE, STATUS_ACTIVE])) {
                $query->where('status', '=', $request->status);
            }
            if (!empty($request->centre)) {
                $centre = $request->centre;
                $query->whereHas('centres', function($q) use($centre) {
                    $q->where('centre_id', $centre);
                });
            }
            return DataTables::eloquent($query)
                            ->addColumn('centre', function (User $user) {
                                return $user->centres->pluck('name')->first();
                            })
                            ->addColumn('classes', function (User $user) {
                                return $user->classes->pluck('name')->first();
                            })
                            ->addColumn('status', function (User $user) {
                                if ($user->status == 1) {
                                    return '<span class="label label-sm label-success">Active</span>';
                                } else {
                                    return '<span class="label label-sm label-danger">Inactive</span>';
                                }
                            })
                            ->addColumn('actions', function(User $user) {
                                return '<a class="btn btn-sm btn-primary" href="teacher/edit/' . $user->id . '"><i class="fa fa-edit"></i></a> '
                                        . '<a  class="btn btn-sm btn-primary" href="teacher/show/' . $user->id . '"><i class="glyphicon glyphicon-eye-open" title="View"></i></a>'
                                        . '&nbsp;<button  type="button" onclick="deleteTeacher(' . $user->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>';
                            })->addIndexColumn()->rawColumns(['actions', 'status'])->make(true);
        }
        $centres = Centre::get();
        return view('teachers.list', compact('centres'));
    }

    public function create() {
        $centres = Centre::get();
        $classes = ClassModel::get();
        $permissions = Permission::get();
        return view('teachers.create', compact('centres', 'permissions', 'classes'));
    }

    public function store(TeacherStoreRequest $request) {
        $data = $request->all();
        $data['role'] = User::TEACHER;
        $data['password'] = Hash::make($data['password']);
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $user = User::create($data);
        $this->syncCert($request->cert, $user->id);
        $user->centres()->attach($request->centre);
        $user->classes()->attach($request->classes);
        $user->permissions()->attach($request->permission);
        Mail::send('emails.teacher_cred', ['user' => $user, 'password' => $request->password], function($message)use($user) {
            $message->to($user->email, $user->name)
                    ->subject('Your Account Created - Credentials');
        });
        session()->flash('success', 'Teacher Registered Successfully');
        return redirect()->route('admin.teachers');
    }

    public function show($id) {
        $teacher = User::whereId($id)->first();
        return view('teachers.show', compact('teacher'));
    }

    public function edit($id) {
        $centres = Centre::get();
        $permissions = Permission::get();
        $classes = ClassModel::get();
        $user = User::whereId($id)->first();
        return view('teachers.edit', compact('centres', 'user', 'permissions', 'classes'));
    }

    public function update(UpdateTeacherRequest $request, $id) {
        $data = $request->except('_token');
        $user = User::find($id);
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->name = $data['first_name'] . ' ' . $data['last_name'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];
        $user->address = $data['address'];
        $user->postcode = $data['postcode'];
        $user->suburb = $data['suburb'];
        $user->state = $data['state'];
        $user->save();
        $this->syncCert($request->cert, $user->id, 1);
        $user->centres()->sync($request->centre);
        $user->classes()->sync($request->classes);
        $user->permissions()->sync($request->permission);
        session()->flash('success', 'Teacher Updated Successfully');
        return redirect()->route('admin.teachers');
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->centres()->detach();
        $user->delete();
        session()->flash('success', 'Teacher Deleted Successfully');
        return redirect()->route('admin.teachers');
    }

    public function accountStatus(Request $request) {
        $user = User::where('id', $request->user_id)->update(['status' => $request->status]);
        if (!$user) {
            return false;
        }
        return true;
    }

    public function syncCert($certs, $id, $edit = null) {
        if ($edit == 1) {
            TeacherCertification::where('user_id', $id)->delete();
        }
        foreach ($certs as $cert) {
            if (!empty($cert['detail'])) {
                $certi = new TeacherCertification();
                $certi->user_id = $id;
                $certi->detail = $cert['detail'];
                $certi->certification_status = $cert['certification_status'];
                $certi->expiry = $cert['expiry'];
                $certi->save();
            }
        }
    }

    function deleteTeacher(Request $request) {
        if (!empty($request->id)) {
            User::where('id', '=', $request->id)->delete();
            echo '1';
            die;
        }
        echo '0';
        die;
    }

}
