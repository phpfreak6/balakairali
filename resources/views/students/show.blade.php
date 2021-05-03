@extends('layouts/main')
@section('title')
Show Student
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 text-center">
        @permission('editing_teacher')
        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn-sm btn btn-purple">
            <i class="ace-icon fa fa-edit  bigger-110 icon-only"></i> Edit</a>
        <button class="btn-sm btn btn-success add_marks"><i class="ace-icon fa fa-certificate"></i> Add Marks</button>
        <button class="btn-sm btn btn-primary progress_report"><i class="fa fa-bar-chart"></i> Progress Report</button>
        @endpermission
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Personal Detail</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="profile-user-info profile-user-info-striped">
                                @permission('editing_teacher')
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Account </div>
                                    <div class="profile-info-value">
                                        <span class="editable " id="first_name">
                                            <strong>Status :</strong> <select class="account_status">
                                                <option value="1" {{ ($student->status == '1') ? 'selected' : '' }}>ACTIVE</option>
                                                <option value="0" {{ ($student->status == '0') ? 'selected' : '' }}>INACTIVE</option>
                                            </select>
                                            <a href="{{ route('admin.student.delete',$student->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-minier btn-danger"><i class="ace-icon fa fa-trash-o"></i> Delete Account</a>
                                        </span>
                                    </div>
                                </div>
                                @endpermission
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> ID </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name"><strong>{{ $student->id }}</strong></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> First Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ $student->first_name }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Last Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="last_name">{{ $student->last_name }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> DOB </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->dob }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Gender </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->gender }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Address </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->address }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Suburb </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->suburb }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Post Code </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->postcode }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> State </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $student->state }}</span>
                                    </div>
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
                        <div class="col-xs-12 col-sm-6">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Parent 1 Type </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ ucfirst($student->student->p1_type) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> First Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ ucfirst($student->student->p1_first_name) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Last Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="last_name">{{ ucfirst($student->student->p1_last_name) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="age">{{ $student->student->p1_email }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Mobile </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="signup">{{ $student->student->p1_mobile }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($student->student->p2_type))
                        <div class="col-xs-12 col-sm-6">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Parent 2 Type </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ ucfirst($student->student->p2_type) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> First Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ ucfirst($student->student->p2_first_name) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Last Name </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="last_name">{{ ucfirst($student->student->p2_last_name) }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="age">{{ $student->student->p2_email }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Mobile </div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="signup">{{ $student->student->p2_mobile }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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

                <h5 class="widget-title">Centre & Class</h5>



            </div>



            <div class="widget-body">

                <div class="widget-main">

                    <div class="row">

                        <div class="col-xs-12 col-sm-6">

                            <div class="profile-user-info profile-user-info-striped">

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Centre </div>



                                    <div class="profile-info-value">

                                        <span class="editable editable-click" id="centre">{{ $student->student->centres->name }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6">

                            <div class="profile-user-info profile-user-info-striped">

                                <div class="profile-info-row">

                                    <div class="profile-info-name"> Class </div>



                                    <div class="profile-info-value">

                                        <span class="editable editable-click" id="classes">{{ $student->student->studentclasses->name }}</span>

                                    </div>

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

                <h5 class="widget-title">Others</h5>



            </div>



            <div class="widget-body">

                <div class="widget-main">

                    <div class="row">

                        <div class="col-xs-12 col-sm-6">

                            <div class="profile-user-info profile-user-info-striped">

                                <div class="profile-info-row">

                                    <div class="profile-info-name"> Main School Name </div>



                                    <div class="profile-info-value">

                                        <span class="editable editable-click" id="centre">{{ $student->student->main_school }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6">

                            <div class="profile-user-info profile-user-info-striped">

                                <div class="profile-info-row">

                                    <div class="profile-info-name"> Main School Class </div>



                                    <div class="profile-info-value">

                                        <span class="editable editable-click" id="classes">{{ $student->student->main_class }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row" style="margin-top: 5px;">

                        <div class="col-xs-12 col-sm-12">

                            <div class="profile-user-info profile-user-info-striped">

                                <div class="profile-info-row">

                                    <div class="profile-info-name"> Remarks </div>



                                    <div class="profile-info-value">

                                        <span class="editable editable-click" id="first_name">{{ $student->student->remarks }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade in" id="marksModel" tabindex="-1" role="dialog" >

    <div class="modal-dialog" role="document">

        <div class="modal-content ">

            <div class="modal-header panel-heading">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title" id="markPaidLabel">Add Test Marks</h4>

            </div>



            <div class="modal-body">

                <form method="post" action="" id="marksFormm">

                    @csrf

                    <div class="row">

                        <div class="col-md-8 imm_slect">

                            <div class="form-group">

                                <label for="mPaidYear">Term</label>

                                <select id="term" name="term" class="form-control">

                                    @foreach($terms as $term)
                                    <option value="{{ $term->name }}">{{ $term->name }}</option>
                                    @endforeach

                                </select>   

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8 imm_slect">

                            <div class="form-group">

                                <label for="mPaidYear">Test Name</label>

                                <input type="text" name="test" class="form-control" placeholder="Test Name" required="">  

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8 imm_slect">

                            <div class="form-group ">

                                <label for="mPaidYear">Obtained Marks</label>

                                <input type="number" name="obtained_marks" class="form-control" placeholder="Obtained Marks" required="">  

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8 imm_slect">

                            <div class="form-group ">

                                <label for="mPaidYear">Total Marks of Test</label>

                                <input type="number" name="test_total_marks" class="form-control" placeholder="Total Marks of Test" required="">  

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8 imm_slect">

                            <div class="form-group">

                                <label for="mPaidYear">Test Date</label>

                                <input type="text" name="date_of_test" class="form-control datepicker" placeholder="Test Date" required="">  

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-12 text-center">

                            <button type="submit" class="btn btn-lg btn-success">Save</button>

                        </div>

                    </div>

                    <input type="hidden" name="user_id" value="{{ $student->id }}">    

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade in" id="progressModel" tabindex="-1" role="dialog" >

    <div class="modal-dialog" role="document">

        <div class="modal-content ">

            <div class="modal-header panel-heading">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title" id="markPaidLabel">Download Progress Report</h4>

            </div>



            <div class="modal-body">

                <form method="post" action="{{ route('admin.student.studentProgress',$student->id) }}" id="progressFormm">

                    @csrf

                    <div class="row text-center">

                        <div class="col-md-8 text-left imm_slect">

                            <div class="form-group">

                                <label for="p_year">Select Year</label>

                                <select id="p_year" name="p_year" class="form-control">

                                    <option value="2021">2021</option>

                                    <option value="2022">2022 </option>


                                </select>  

                            </div>

                            <div class="form-group">

                                <label for="p_term">Select Term</label>

                                <select id="p_term" name="p_term" class="form-control">

                                    @foreach($terms as $term)
                                    <option value="{{ $term->name }}">{{ $term->name }}</option>
                                    @endforeach


                                </select>  

                            </div>

                        </div>

                    </div>





                    <div class="row">

                        <div class="col-md-12 text-center">

                            <button type="submit" class="btn btn-lg btn-success">Download</button>

                        </div>

                    </div>    

                </form>

            </div>

        </div>

    </div>

</div>
<input type="hidden" name="student_id" id="student_id" value="{{ $student->id }}">
@endsection

@section('scripts')

<script src="{{ asset('assets/js/student/scripts.js') }}"></script>

@endsection