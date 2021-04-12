@extends('layouts/main')
@section('title')
Create Teacher
@endsection
@section('content')
<form id="store_student_form" class="form-horizontal" action="{{ route('admin.teachers.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                <div class="widget-header">
                    <h5 class="widget-title">Personal Detail</h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="firstname"> First Name : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="firstname" name="first_name" placeholder="First Name"  value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="lastname"> Last Name : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="lastname" name="last_name"  value="{{ old('last_name') }}" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="email"> Email : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="email" name="email"  value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="mobile"> Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="mobile" name="mobile"  value="{{ old('mobile') }}" placeholder="Mobile" class="form-control @error('mobile') is-invalid @enderror">
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="address"> Address : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="address" name="address"  value="{{ old('address') }}" placeholder="Address" class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="suburb"> Suburb : </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="suburb" name="suburb"  value="{{ old('suburb') }}" placeholder="Suburb" class="form-control @error('suburb') is-invalid @enderror">
                                        @error('suburb')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="postcode"> Post Code : </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="postcode" name="postcode"  value="{{ old('postcode') }}" placeholder="Post Code" class="form-control @error('postcode') is-invalid @enderror">
                                        @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="state"> State : </label>
                                    <div class="col-sm-8">
                                        <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                                            <option value="">Select State</option>
                                            @foreach(states() as $state)
                                            <option {{ old('state') == $state ? "selected" : "" }} value="{{ $state }}">{{ $state }}</option>
                                            @endforeach
                                        </select>
                                        @error('state')
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
    <div class="row">
        <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                <div class="widget-header">
                    <h5 class="widget-title">Assign Centre, Class and Permission</h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="centre"> Centre : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('centre') is-invalid @enderror" id="centre" name="centre[]" >
                                            @foreach($centres as $centre)
                                            <option value="{{ $centre->id }}" {{ old('centre[]') == $centre->id ? "selected" : "" }}>{{ $centre->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('centre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="centre"> Class : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('classes') is-invalid @enderror" id="classes" name="classes[]" >
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="permission"> Permissions : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('permission') is-invalid @enderror" id="permission" name="permission[]" >
                                            @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->display }}</option>
                                            @endforeach
                                        </select>
                                        @error('permission')
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
    <div class="row">
        <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                <div class="widget-header">
                    <h5 class="widget-title">Certifications Details</h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main ">
                        <div class="append_cert_html">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="detail">1) Detail : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="cert[1][detail]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="certification_status"> Status : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="certification_status" name="cert[1][certification_status]">
                                                <option value="">Select Status</option>
                                                <option value="1">VALID</option>
                                                <option value="0">EXPIRED</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="expiry"> Expiry : </label>
                                        <div class="col-sm-8">
                                            <input type="text" id="expiry" name="cert[1][expiry]" class="form-control datepicker1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="margin-top: 5px">
                                <div class="form-group">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success btn-sm add_mor_cert"><i class="fa fa-plus"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                <div class="widget-header">
                    <h5 class="widget-title">Password</h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="password"> Password : </label>
                                    <div class="col-sm-8">
                                        <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="password-confirm"> Confirm Password : </label>
                                    <div class="col-sm-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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
@section('scripts')
<script src="{{ asset('assets/js/teacher/custom.js') }}"></script>
<script>
appendClasses();
$(document).on('change', '#centre', function (e) {
    appendClasses();
});
function appendClasses() {
    blockScreen();
    $.ajax({
        type: 'GET',
        url: URL + "/admin/load_classes_create",
        data: {centre: $('#centre').val()},
        success: function (data) {
            unblockScreen();
            var $select = $('#classes');
            $select.find('option').remove();
            $.each(data.data, function (key, value)
            {
                $select.append('<option value=' + value.id + '>' + value.name + '</option>'); // return empty
            });
            if (data == false) {
                return false;
            }
        },
    });
}
$('#store_student_form').on('submit', function () {
    blockScreen();
});
</script>
@endsection

