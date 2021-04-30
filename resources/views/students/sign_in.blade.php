@extends('layouts/main')
@section('title')
Sign-in / Sign-out Record
@endsection
@section('content')
<div class="row mb-3">
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Filters</h5>
            </div>
            <form action="<?= route('admin.signinSignout') ?>" method="GET" id="signin_form">
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label no-padding-right" for="name"> Select Centre : </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="filter_by_centre" name="centre_value">
                                            <option value="" selected="">Select Centre</option>
                                            @foreach($centres as $centre)
                                            <option <?= $centre_value == $centre->id ? 'selected' : '' ?> value="{{ $centre->id }}">{{ $centre->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label no-padding-right" for="address"> Select Class : </label>
                                    <div class="col-sm-7">
                                        <div class="classes_append">  
                                            <select class="form-control" id="filter_by_class" name="class_value" >
                                                <option value="" selected="">Select Class</option>
                                                @foreach($classes as $class)
                                                <option <?= $class_value == $class->id ? 'selected' : '' ?> value="{{ $class->id }}">
                                                    {{ $class->name }}- <?= $class->centre->name ?>
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-5">
                                <label class="col-sm-5 control-label no-padding-right" for="start_date"> Start Date : </label>
                                <div class="col-sm-7">
                                    <input value="<?= $start_date ?>" type="text" name="start_date" id="start_date" class="datepicker1" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-sm-5 control-label no-padding-right" for="end_date"> End Date : </label>
                                <div class="col-sm-7">
                                    <input value="<?= $end_date ?>" type="text" name="end_date" id="end_date" class="datepicker1" placeholder="End Date">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-success filter_btn">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
        </div>
        <div>
            <table id="login_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Date</th>
                        <th class="center">Student ID</th>
                        <th class="center">Name</th>
                        <th class="center">Class</th>
                        <th class="center">Login Time</th>
                        <th class="center">Logout Time</th>
                        <th class="center">Duration</th>
                        <th class="center">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<?= getDatatableResources() ?>
<script src="{{ asset('assets/theme/js/dataTables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/dataTables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/student/index.js') }}"></script>
@endsection