@extends('layouts/main')
@section('title')
Edit Teacher
@endsection
@section('content')


<form id="store_student_form" class="form-horizontal" action="{{ route('admin.teachers.update',$user->id) }}" method="POST">
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
                                        <input type="text" id="firstname" name="first_name" placeholder="First Name"  value="{{ $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="lastname"> Last Name : </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="lastname" name="last_name"  value="{{ $user->last_name }}" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror">
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
                                        <input type="text" id="email" name="email"  value="{{ $user->email }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
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
                                        <input type="text" id="mobile" name="mobile"  value="{{ $user->mobile }}" placeholder="Mobile" class="form-control @error('mobile') is-invalid @enderror">
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
                                        <input type="text" id="address" name="address"  value="{{ $user->address }}" placeholder="Address" class="form-control @error('address') is-invalid @enderror">
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
                                        <input type="text" id="suburb" name="suburb"  value="{{ $user->suburb }}" placeholder="Suburb" class="form-control @error('suburb') is-invalid @enderror">
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
                                        <input type="text" id="postcode" name="postcode"  value="{{ $user->postcode }}" placeholder="Post Code" class="form-control @error('postcode') is-invalid @enderror">
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
                                            <option {{ $user->state == $state ? "selected" : "" }} value="{{ $state }}">{{ $state }}</option>
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
                                        <select class="form-control  @error('centre') is-invalid @enderror" id="centre" name="centre[]" >
                                            @foreach($centres as $centre)
                                            <option value="{{ $centre->id }}" {{ in_array($centre->id ,$user->centres->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $centre->name }}</option>
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
                                        <select class="form-control  @error('classes') is-invalid @enderror" id="classes" name="classes[]" >
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ in_array($class->id ,$user->classes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('classes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="permission"> Permissions : </label>

                                    <div class="col-sm-8">
                                        <select class="form-control  @error('permission') is-invalid @enderror" id="permission" name="permission[]" >
                                            @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ in_array($permission->id ,$user->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->display }}</option>
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
                    <div class="widget-main">
                        <div class="append_cert_html">
                            @php $x = 1; @endphp
                            @forelse ($user->certifications as $cert)
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="detail">{{$x}}) Detail : </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="cert[{{$x}}][detail]" value="{{  $cert->detail }}" class="form-control ">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="certification_status{{$x}}"> Status : </label>

                                        <div class="col-sm-8">
                                            <select class="form-control" id="certification_status{{ $x }}" name="cert[{{$x}}][certification_status]">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ ($cert->certification_status == 1) ? 'selected' : '' }}>VALID</option>
                                                <option value="0" {{ ($cert->certification_status == 0) ? 'selected' : '' }}>EXPIRED</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="expiry{{ $x }}"> Expiry : </label>

                                        <div class="col-sm-8">
                                            <input type="text" id="expiry{{ $x }}" name="cert[{{$x}}][expiry]" value="{{ $cert->expiry }}" class="form-control datepicker1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    @if($x==1)
                                            <!--button type="button" class="btn btn-success add_btn"><i class="fa fa-plus " ></i></button-->
                                    @else
                                    <button type="button" class="btn btn-danger btn-sm remove_field"><i class="fa fa-minus " ></i></button>
                                    @endif
                                </div>
                            </div>
                            @php $x++; @endphp
                            @empty
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
                            @endforelse

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
<script>
    /*====================================================================================================*/

    var max_fields = 10;
    var wrapper = $('.append_cert_html');
    var add_btn = $('.add_mor_cert');


    var x = '{{ $x-1 }}';
    $(add_btn).click(function (e) {

        e.preventDefault();
        if (x < max_fields) {

            x++;

            $(wrapper).append('<div class="row"><div class="col-sm-4"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="detail">' + x + ') Detail : </label><div class="col-sm-8"> <input type="text" name="cert[' + x + '][detail]" class="form-control"></div></div></div><div class="col-sm-3"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="certification_status"> Status : </label><div class="col-sm-8"> <select class="form-control " id="certification_status' + x + '" name="cert[' + x + '][certification_status]"><option value="">Select Status</option><option value="1">VALID</option><option value="0">EXPIRED</option> </select></div></div></div><div class="col-sm-3"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="expiry"> Expiry : </label><div class="col-sm-8"> <input type="text" id="expiry" name="cert[' + x + '][expiry]" class="form-control datepicker2"></div></div></div><div class="col-sm-2"><button type="button" class="btn btn-danger btn-sm remove_field"><i class="fa fa-minus"></i></button></div></div>');

            refreshDate();

        }

    });

    $(wrapper).on('click', '.remove_field', function () {

        $(this).parent().parent().remove();
        x--;
    });


    function refreshDate() {

        $(".datepicker2").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            useCurrent: true,
            autoclose: true,
            keepOpen: false,
        });

    }


    /*========================================================================================================*/
</script>
<script>

    appendClasses();

    $(document).on('change', '#centre', function (e) {

        appendClasses();

    });
    function appendClasses(id) {

        var classId = $('#classes').val();

        blockScreen();
        //table.draw();    

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
                    if (value.id == classId) {
                        var $selected = 'selected';
                    } else {
                        var $selected = '';
                    }

                    $select.append('<option value=' + value.id + ' ' + $selected + '>' + value.name + '</option>'); // return empty
                });
                if (data == false) {
                    return false;
                }
                //$('.classes_append').html(data);


            },
        });
    }
</script>
@endsection

