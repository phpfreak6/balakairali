@extends('layouts/main')
@section('title')
Add Centre
@endsection
@section('content')
<form class="form-horizontal" action="{{ route('admin.centre.update',$centre->id) }}" method="post">
    @csrf
<div class="row">
    
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Centre Detail</h5>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="name"> Name : </label>

                            <div class="col-sm-8">
                                <input type="text" id="name" name="name" value="{{ $centre->name }}" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="address"> Address : </label>

                            <div class="col-sm-8">
                                <textarea class="form-control" id="address" name="address" placeholder="Address">{{ $centre->address }}</textarea>
                            </div>
                        </div>  
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions center">
    <button type="submit" class="btn btn-sm btn-success">
        Submit
        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
    </button>
</div>
</form>
@endsection