<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use DataTables;

class TeacherResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       if($request->ajax())
	     {
	        $query = Resource::query();

	        if(!empty($request->file_type)){
	        	$query->where('doc_type',$request->file_type);

	        }
            return DataTables::eloquent($query)
	            ->addColumn('actions', function(Resource $resource) {
	                            return '<a class="btn btn-sm btn-primary" href="'.url('/').'/uploads/resources/'.$resource->mime_type.'/'.$resource->file_name.'" download="'.$resource->file_name.'"><i class="fa fa-download"></i></a> <!--a class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a-->';
	                        })->addIndexColumn()->rawColumns(['actions'])->make(true);
	     }
       
       return view('resource.index');
 
    }

    
    

    /**
     * Upload files
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {

    	// echo "<pre>";
    	// print_r($request->all());
    	// die;
        
    	foreach ($request->attachment as $key => $file) {

    		$mime = $file->getMimeType();
            $type = explode("/", $mime);
            
    	    
    		$new_name = rand() . '_' . $file->getClientOriginalName();
		    $file->move(public_path('uploads/resources/'.$type[0]), $new_name);

		    $resource = new Resource();
		    $resource->title = $request->title;
		    $resource->doc_type = $request->file_type;
		    $resource->mime_type = $type[0];
		    $resource->file_name = $new_name;
		    $resource->save();
    		
    	}

    	echo "<pre>";
    	
    	die;

       //return view('resource.index');

    }
}
