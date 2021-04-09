@extends('layouts/main')
@section('title')
Assign Kids
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-offset-2">
                <div class="search-area well well-sm" id="kids-listing">
                    <div class="widget-header widget-header-small">
                        <h4 class="widget-title blue smaller">
                            <i class="ace-icon fa fa-users orange"></i>
                            Kids
                        </h4>
                    </div>

                    <div class="space-10"></div>

                    <div class="kids-listing">
                        <div class="profile-user-info profile-user-info-striped">
                            @php $x = 1; @endphp
                            @foreach($students as $student)
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{$x}}. </div>

                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="username">{{ $student->user->name }}</span>
                                    </div>
                                </div>
                            @php $x++; @endphp
                            @endforeach
                        </div>
                        <div class="space-20"></div>
                        @if(empty($checkAssignedOther))
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                                <h4 class="widget-title blue smaller">
                                    <i class="ace-icon fa fa-rss orange"></i>
                                    Assign To
                                </h4>
                            </div>
                            <input type="hidden" id="main_parent_num" value="{{ $number }}">
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <input type="text" id="another_parent_number" class="form-control" placeholder="Enter Parent Name Or Parent Mobile Number">
                                        </div>
                                        <div class="col-md-4">

                                            <button class="btn btn-primary btn-sm" id="btn-search-parent" data-parent="{{ $number }}">Find</button>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                     
                                      <div class="col-xs-12 col-sm-8">
                                         <div id="parent_list">
                                             
                                         </div>
                                      </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                                <h4 class="widget-title blue smaller">
                                    <i class="ace-icon fa fa-rss orange"></i>
                                    Assigned
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                
                                    <div class="row" style="margin-top: 10px;">
                                     
                                      <div class="col-xs-12 col-sm-8">
                                         <div id="parent_list">
                                             <div class="profile-user-info profile-user-info-striped">
                                                <div class="profile-info-row">
                                        
                                                    <div class="profile-info-name"><span><button class="btn btn-success btn-sm" id="btn-unassign" data-unassign="{{ $checkAssignedOther->p1_mobile }}">Un-Assign</button></span> </div>
                                                    <div class="profile-info-value">
                                                        <span class="editable editable-click" id="username">{{ ucfirst($checkAssignedOther->p1_first_name) }} {{ ucfirst($checkAssignedOther->p1_last_name) }} - <strong>{{ $checkAssignedOther->p1_mobile }}</strong></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                         </div>
                                      </div>

                                        
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


@endsection

@section('scripts')




<script src="{{ asset('assets/js/assign/index.js') }}"></script>



@endsection