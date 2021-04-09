@extends('layouts.main')
@section('title')
Manage Attendance
@endsection
@section('content')
<div class="row mb-3">
    
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Mark Attendance</h5>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            
                                <select class="form-control input-sm" id="filter_by_centre" name="centre" required="">
                                    <option value="" selected="">Select Centre</option>
                                        @foreach($centres as $centre)
                                        <option value="{{ $centre->id }}">{{ $centre->name }}</option>
                                        @endforeach
                                </select>
                          
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <div class="classes_append"> 
                               <select class="form-control input-sm" id="classes" name="classes" >
                                    <option value="" selected="">Select Class</option>
                
                               </select>
                           </div>
                            
                        </div>  
                    </div>
                   
                    <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="date" id="date" class="input-sm datepicker2" placeholder="Attendance Date">
                    </div>
                    </div>
                    
                     <div class="col-sm-2">

                         <button class="btn btn-primary btn-sm attendance_mark_filter">Filter</button>
                      
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12">
        <div class="text-center table-header">
               
            

        </div> 
    </div>
    <div class="col-xs-12 append_attendance_table">
      
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('assets/js/attendance/index.js') }}"></script>
@endsection
