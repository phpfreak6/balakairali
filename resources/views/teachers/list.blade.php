@extends('layouts/main')
@section('title')
Manage Teachers
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            <div class="row">               
                <div class="col-sm-2">              
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-success btn-sm"><i class="glyphicon-plus glyphicon"></i> Add</a>         
                </div>              
                <div class="col-sm-2">
                    <select id="filter_by_centre" class="form-control input-sm year" name="centre" style="margin-top: 6px;" required="">                      
                        <option value="">By Center</option>                     
                        @foreach($centres as $centre)                       
                        <option value="{{ $centre->id }}">{{ $centre->name }}</option>       
                        @endforeach                   
                    </select>                   
                </div> 
                <div class="col-sm-2">
                    <?= Form::select('status', ['' => 'By Status', '0' => 'Inactive', '1' => 'Active'], '', ['style' => 'margin-top: 6px;', 'class' => 'input-sm form-control', 'id' => 'status']) ?>
                </div>
                <div class="col-sm-2">                   
                    <button id="by_centre_btn" type="button" class="btn btn-success btn-sm" >Filter</button>                
                </div>                  
            </div>
        </div>
        <div class="responsive_table_main">
            <div class="responsive_table">
                <table id="teachers_datatable" class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="center">ID</th>
                            <th class="center">Name</th>
                            <th class="center">Email</th>
                            <th class="center">Mobile</th>
                            <th class="center">Centre</th>
                            <th class="center">Class</th>
                            <th class="center">Status</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= getDatatableResources() ?>
<script src="{{ asset('assets/js/teacher/index.js') }}"></script>
@endsection