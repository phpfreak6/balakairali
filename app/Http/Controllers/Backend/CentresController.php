<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use Illuminate\Http\Request;
use App\Models\Centre;
use App\Models\User;
use DataTables;

class CentresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->ajax()){

            $query = Centre::get();
            return DataTables::of($query)
                        ->addColumn('actions', function(Centre $centre) {
                            if(User::hasPermission('editing_teacher')){
                            return '<a class="btn btn-sm btn-primary" href="centre/edit/'.$centre->id.'"><i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-danger" href="centre/delete/'.$centre->id.'"><i class="fa fa-trash"></i></a>';
                            }else{
                                return '';
                            }
                        })->addIndexColumn()->rawColumns(['actions'])->make(true);
        
        }
        return view('centres.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
       if(User::hasPermission('accessing_teacher')){

         return abort('403','You cannot access this route.');

        }

       return view('centres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentreRequest $request)
    {
        $store = Centre::create($request->all());

        if($store){

           session()->flash('success','Centre Created Successfully');

        }else{

            session()->flash('error','Something Went Wrong.');
            
        }

        return redirect()->route('admin.centres');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::hasPermission('accessing_teacher')){

         return abort('403','You cannot access this route.');
         
        }
        $centre = Centre::find($id);
        return view('centres.edit',compact('centre'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCentreRequest $request, $id)
    {
        $update = Centre::find($id);
        $update->name = $request->name;
        $update->address = $request->address;
        $update->save();
        session()->flash('success','Centre Updated Successfully');
        return redirect()->route('admin.centres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(User::hasPermission('accessing_teacher')){

         return abort('403','You cannot access this route.');
         
        }
        Centre::find($id)->delete();
        session()->flash('success','Centre Deleted Successfully');
         return redirect()->back();
    }
}
