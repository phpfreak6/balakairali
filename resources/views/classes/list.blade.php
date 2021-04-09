@extends('layouts/main')

@section('title')

Manage Classes

@endsection

@section('content')
@permission('accessing_teacher') 
<style>
    #classes_datatable .classes_actions{
        display: none;
    }
</style>
@endpermission
<div class="row">

    <div class="col-xs-12">

        <div class="table-header">
             
            <div class="row">  

                <div class="col-sm-2">              
                  @permission('editing_teacher') 
                   <a href="{{ route('admin.class.create') }}" class="btn btn-success btn-sm"><i class="glyphicon-plus glyphicon"></i> Add</a> 
                   @endpermission      
                </div>              
                             
                    <div class="col-sm-2">                  
                        <select id="filter_by_centre" class="form-control input-sm year" name="centre" style="margin-top: 6px;" required="">                      
                            <option value="" >By Center</option>                     
                            @foreach($centres as $centre)                       
                            <option value="{{ $centre->id }}">{{ $centre->name }}</option>    @endforeach                   
                        </select>                   
                    </div>              
        
                    <div class="col-sm-2">                   
                        <button id="by_centre_btn" type="button" class="btn btn-success btn-sm" >Filter</button>                
                    </div>                  
                        
            </div>

        </div>

        <div>

            <table id="classes_datatable" class="table table-striped table-bordered table-hover">

                <thead>

                    <tr>

                        <th class="center">ID</th>

                        <th class="center">Centre Name</th>
                        <th class="center">Class Name</th>
                        <div  style="display: none;">
                        <th class="center" >Actions</th>
                        </div>

                    </tr>

                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>

<?= getDatatableResources() ?>

<script src="{{ asset('assets/js/classes/index.js') }}"></script>

@endsection