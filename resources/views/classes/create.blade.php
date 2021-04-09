@extends('layouts/main')
@section('title')
Add Class
@endsection
@section('content')
<form class="form-horizontal" action="{{ route('admin.class.store') }}" method="post">
    @csrf
<div class="row">
    
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Class Detail</h5>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">					<div class="col-sm-8">                        <div class="form-group">                            <label class="col-sm-4 control-label no-padding-right" for="name"> Select Centre : </label>                            <div class="col-sm-8">                                <select id="centre" class="form-control centre" name="centre" style="margin-top: 6px;" required="">																  <option value="">Select Centre</option>								  								    @foreach($centres as $centre)									  <option value="{{ $centre->id }}">{{ $centre->name }}</option>									@endforeach 								  								</select>                                  @error('centre')                                    <span class="invalid-feedback" role="alert">                                        <strong>{{ $message }}</strong>                                    </span>                                @enderror                            </div>                        </div>                      </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="name"> Class Name : </label>

                            <div class="col-sm-8">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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