@extends('layouts/main')

@section('title')

Edit Student

@endsection

@section('content')

<form id="store_student_form" class="form-horizontal" action="{{ route('admin.student.update',$user->id) }}" method="POST">

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

                        <!--div class="form-group">

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

                        </div-->

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="dob"> DOB : </label>



                            <div class="col-sm-8">

                                <input type="text" id="dob" name="dob"  value="{{ $user->dob }}" placeholder="DOB" class="form-control datepicker @error('dob') is-invalid @enderror">

                                 @error('dob')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>
                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="gender"> Gender : </label>



                            <div class="col-sm-8">

                               <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">

                                   <option value="Male" {{ ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>

                                   <option value="Female" {{ ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>


                               </select>

                                @error('gender')

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

                                <input type="text" id="state" name="state"  value="{{ $user->state }}" placeholder="State" class="form-control @error('state') is-invalid @enderror">

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

                <h5 class="widget-title">Assign Centre and Class</h5>



            </div>



            <div class="widget-body">

                <div class="widget-main">

                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="centre"> Centre : </label>



                                <div class="col-sm-8">

                                    <select class="form-control @error('centre') is-invalid @enderror" id="centre" name="centre">

                                        @foreach($centres as $centre)

                                        <option value="{{ $centre->id }}" {{ ($user->student->centre == $centre->id) ? 'selected' : '' }}>{{ $centre->name }}</option>

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

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="classes"> Class : </label>



                                <div class="col-sm-8">

                                    <select class="form-control @error('classes') is-invalid @enderror" id="classes" name="classes" >

                                        @foreach($classes as $class)

                                        <option value="{{ $class->id }}" {{ ($user->student->classes == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>

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

                <h5 class="widget-title">Parent Details</h5>



            </div>

            

            <div class="widget-body">

                <div class="widget-main">

                    <div class="row">

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p1_type"> Parent-1 Type: </label>



                            <div class="col-sm-8">

                                <select class="form-control @error('p1_type') is-invalid @enderror" id="p1_type" name="p1_type">

                                   <option value="father" {{ ($user->student->p1_type =='father') ? 'selected' : '' }} >Father</option>

                                   <option value="mother" {{ ($user->student->p1_type=='mother') ? 'selected' : '' }}>Mother</option>

                                   <option value="guardian" {{ ($user->student->p1_type =='guardian') ? 'selected' : '' }}>Guardian</option>

                                

                                </select>

                                @error('p1_type')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p1_first_name"> Parent-1 First Name : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p1_first_name" name="p1_first_name"  value="{{ $user->student->p1_first_name }}" placeholder="First Name" class="form-control @error('p1_first_name') is-invalid @enderror">

                                @error('p1_first_name')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p1_last_name"> Parent-1 Last Name : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p1_last_name" name="p1_last_name"  value="{{ $user->student->p1_last_name }}" placeholder="Last Name" class="form-control @error('p1_last_name') is-invalid @enderror">

                                @error('p1_last_name')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p1_email"> Parent-1 Email : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p1_email" name="p1_email"  value="{{ $user->student->p1_email }}" placeholder="Email" class="form-control @error('p1_email') is-invalid @enderror">

                                @error('p1_email')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p1m"> Parent-1 Mobile : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p1m" name="p1_mobile"  value="{{ $user->student->p1_mobile }}" placeholder="Mobile" class="form-control @error('p1_mobile') is-invalid @enderror">

                                @error('p1_mobile')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        

                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p2_type"> Parent-2 Type: </label>



                            <div class="col-sm-8">

                                <select class="form-control @error('p2_type') is-invalid @enderror" id="p2_type" name="p2_type">

                                   <option value="father" {{ ($user->student->p2_type =='father') ? 'selected' : '' }}>Father</option>

                                   <option value="mother" {{ ($user->student->p2_type =='mother') ? 'selected' : '' }}>Mother</option>

                                   <option value="guardian" {{ ($user->student->p2_type =='guardian') ? 'selected' : '' }}>Guardian</option>

                                </select>

                                @error('p2_type')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p2_first_name"> Parent-2 First Name : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p2_first_name" name="p2_first_name"  value="{{ $user->student->p2_first_name }}" placeholder="First Name" class="form-control @error('p2_first_name') is-invalid @enderror">

                                @error('p2_first_name')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p2_last_name"> Parent-2 Last Name : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p2_last_name" name="p2_last_name"  value="{{ $user->student->p2_last_name }}" placeholder="Last Name" class="form-control @error('p2_last_name') is-invalid @enderror">

                                @error('p2_last_name')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p2_email"> Parent-2 Email : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p2_email" name="p2_email"  value="{{ $user->student->p2_email }}" placeholder="Email" class="form-control @error('p2_email') is-invalid @enderror">

                                @error('p2_email')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="p2_mobile"> Parent-2 Mobile : </label>



                            <div class="col-sm-8">

                                <input type="text" id="p2_mobile" name="p2_mobile"  value="{{ $user->student->p2_mobile }}" placeholder="Mobile" class="form-control @error('p2_mobile') is-invalid @enderror">

                                @error('p2_mobile')

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

                <h5 class="widget-title">Emergency Contact </h5>



            </div>



            <div class="widget-body">

                <div class="widget-main">

                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="e_person_name"> Person Name : </label>


                                <div class="col-sm-8">

                                    <input id="e_person_name" type="text" value="{{ $user->student->e_person_name }}"  class="form-control" name="e_person_name">

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="e_person_phone"> Phone : </label>



                                <div class="col-sm-8">

                                    <input id="e_person_phone" type="text" value="{{ $user->student->e_person_phone }}" class="form-control" name="e_person_phone">

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="e_person_email"> Email : </label>



                                <div class="col-sm-8">

                                    <input id="e_person_email" type="text" value="{{ $user->student->e_person_email }}" class="form-control" name="e_person_email">

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

<div class="row">

    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">

        <div class="widget-box ui-sortable-handle" id="widget-box-1">

            <div class="widget-header">

                <h5 class="widget-title">Other Details</h5>



            </div>



            <div class="widget-body">

                <div class="widget-main">

                     <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="main_school"> Main School Name : </label>


                                <div class="col-sm-8">

                                    <input id="main_school" type="text"  class="form-control" value="{{ $user->student->main_school }}" name="main_school">

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label class="col-sm-4 control-label no-padding-right" for="main_class"> Main School Class : </label>



                                <div class="col-sm-8">

                                    <input id="main_class" type="text" class="form-control" value="{{ $user->student->main_class }}" name="main_class">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="form-group">

                                <label class="col-sm-2 control-label no-padding-right" for="remarks"> Remarks : </label>



                                <div class="col-sm-4"> 

                                    <textarea name="remarks" id="remarks"  class="form-control @error('remarks') is-invalid @enderror" placeholder="Remarks">{{ $user->student->remarks }}</textarea>

                                    @error('remarks')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="form-group">

                                <label class="col-sm-2 control-label no-padding-right" for="remarks"> Student's 4 digit PIN : </label>



                                <div class="col-sm-4"> 

                                    <input name="pin" id="pin"  class="form-control" value="{{ old('pin') }}" placeholder="4 Digit Pin">

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


    appendClasses();
    
    $(document).on('change', '#centre', function(e){  
       
      appendClasses();

    });
     function appendClasses(){

        var classId = $('#classes').val();

        blockScreen();

        
        //table.draw();    
        
        $.ajax({        
            type: 'GET',        
            url: URL + "/admin/load_classes_create",

            data: { centre : $('#centre').val() },

            success: function (data) { 
             
            unblockScreen();  

                var $select = $('#classes');

                $select.find('option').remove();

                $.each(data.data,function(key, value)
                {
                    if(value.id == classId){
                       var $selected = 'selected';
                    }else{
                       var $selected = '';
                    }

                    $select.append('<option value=' + value.id + ' ' + $selected + '>' + value.name + '</option>'); // return empty
                });
            if(data == false){
                return false;
            }
            //$('.classes_append').html(data);

                  
            },    
        });
}
</script>
@endsection


