@extends('layouts/main')
@section('title')
Show Teacher
@endsection
@section('content')

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
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Account </div>

                                    <div class="profile-info-value">
                                        <span class="editable " id="first_name">
                                           <strong>Status :</strong> <select class="account_status">
                                                <option value="1" {{ ($teacher->status == '1') ? 'selected' : '' }}>ACTIVE</option>
                                                <option value="0" {{ ($teacher->status == '0') ? 'selected' : '' }}>INACTIVE</option>
                                            </select>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-minier btn-purple"><i class="ace-icon fa fa-edit  bigger-110 icon-only"></i> Edit</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('admin.teachers.delete',$teacher->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-minier btn-danger"><i class="ace-icon fa fa-trash-o"></i> Delete Account</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> First Name </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ $teacher->first_name }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Last Name </div>

                                    <div class="profile-info-value">
                                        
                                        <span class="editable editable-click" id="last_name">{{ $teacher->last_name }}</span>
                                   
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="age">{{ $teacher->email }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Mobile </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="signup">{{ $teacher->mobile }}</span>
                                    </div>
                                </div>

                                <!--div class="profile-info-row">
                                    <div class="profile-info-name"> DOB </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->dob }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Gender </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->gender }}</span>
                                    </div>
                                </div-->
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Address </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->address }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Suburb </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->suburb }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Post Code </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->postcode }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> State </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="login">{{ $teacher->state }}</span>
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
                <h5 class="widget-title">Centre & Permission</h5>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="profile-user-info profile-user-info-striped">
                                
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Centre </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ (isset($teacher->centres)) ? $teacher->centres->pluck('name')->first() : 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Class </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name">{{ (isset($teacher->classes)) ? $teacher->classes->pluck('name')->first() : 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Permission</div>

                                    <div class="profile-info-value">
                                        
                                        <span class="editable editable-click" id="last_name">{{ (isset($teacher->permissions)) ? $teacher->permissions->pluck('display')->first() : 'N/A' }}</span>
                                   
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
                <h5 class="widget-title">Certifications Details</h5>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="profile-user-info profile-user-info-striped">
                                @php $x = 1; @endphp
                                @foreach($teacher->certifications as $cert)
                                <div class="profile-info-row">
                                    <div class="profile-info-name">{{ $x }}.</div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="first_name"><strong>Detail: </strong>{{ ($cert->detail) }}</span><br/>
                                        <span class="editable editable-click" id="first_name"><strong>Status: </strong>{{ ($cert->certification_status == 1) ? 'VALID' : 'EXPIRED' }}</span><br/>
                                         <span class="editable editable-click" id="first_name"><strong>Expiry: </strong>{{ ($cert->expiry) }}</span>
                                    </div>
                                </div>
                                
                                @php $x++; @endphp
                                @endforeach

                            
                            </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')

<script>
    
    $('.account_status').on('change', function(){

        var status = $(this).val();

         blockScreen();

         $.ajax({
            type: 'POST',
            url: "{{ route('admin.teacher.accountStatus') }}",
            data: {_token: _TOKEN, status: status, user_id:"{{ $teacher->id }}"},
            success: function (data) {
             unblockScreen();
             toastr.options = {"closeButton": true};
             toastr.success('Account Status Changed.');
               //alert();
            },
        });

    });

</script>

@endsection