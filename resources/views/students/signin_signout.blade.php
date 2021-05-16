@extends('layouts/main')

@section('title')

Sign-in / Sign-out Kids

@endsection

@section('content')
<style>
    .widget-color-blue {
        border-color: #dddddd !important;
    }
</style>

<div class="row" style="border-bottom: 1px dotted #e2e2e2;padding-bottom: 16px; padding-top: 7px;">
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
        <label>Search Student/s : </label>
    </div>
    <div class="col-md-6" >
        <div class="input-group">

            <input type="text" class="form-control" id="parent_number" placeholder="Enter parents number">

            <div class="input-group-btn">
                <button type="button" class="btn btn-purple no-border btn-sm search-kids">
                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                </button>
            </div>
        </div>
    </div>

</div>
<div class="row " id="append_kids_list_loader" style="margin-top: 10px">

    <div class="col-md-6 col-md-offset-3 append_kids_list" >



    </div>

</div>

@endsection



@section('scripts')



<?= getDatatableResources() ?>

<script src="{{ asset('assets/theme/js/dataTables/dataTables.buttons.min.js') }}"></script>



<script src="{{ asset('assets/theme/js/dataTables/buttons.html5.min.js') }}"></script>



<script src="{{ asset('assets/js/student/login.js') }}"></script>



@endsection