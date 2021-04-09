@extends('layouts.main')
@section('title')
Attendance Report
@endsection
@section('content')
<div class="row mb-3">
    
    <div class="col-xs-12 col-md-12 widget-container-col ui-sortable" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Filters</h5>

            </div>
            <form method="post" id="filter_form">

            <div class="widget-body">
                <div class="widget-main">
                    
                    <div class="row">
                    
            
                     <div class="col-sm-3">
                        <input type="text" name="student_name" class="form-control input-sm" placeholder="Enter Student Name Or ID" style="margin-top: 6px;">
                    </div>
                           
                  
                
                </div>
                <div class="row" style="margin-top: 5px;">
                    
                    <div class="col-sm-2">
                        <div class="form-group">
                        <select id="year" class="form-control input-sm year" name="year" style="margin-top: 6px;" required="">
                          <option value="" selected="">Select Year</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                        </select>
                        </div>    
                    </div> 

                    <div class="col-sm-2">
                        <div class="form-group">
                        <select id="term" class="form-control input-sm term" name="term" style="margin-top: 6px;" required="">
                          <option value="">Select Term</option>
                        @foreach($quarters as $quarter)
                          <option value="{{ $quarter->id }}">{{ $quarter->name }}</option>
                        @endforeach  
                        </select>  
                        </div>  
                    </div>  
                 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select class="form-control input-sm" id="filter_by_centre" style="margin-top: 6px;" name="centre" required="">
                                    <option value="" selected="">Select Centre</option>
                                        @foreach($centres as $centre)
                                        <option value="{{ $centre->id }}">{{ $centre->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="classes_append">  
                                <select class="form-control input-sm" id="filter_by_class" style="margin-top: 6px;" name="classes" >
                                    <option value="" selected="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                         </div>  
                    </div>
                      <div class="col-sm-2" style="margin-top: 6px;"><button type="submit" class="btn btn-sm btn-success filter_btn">Filter</button></div>
                </div>
                </form>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
           <div class="row">
               <div class="col-xs-12">
                   <div id="total_classes"></div>
               </div>
               
           </div>
        
        </div>
        <div>
            <table id="attendance_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Record No.</th>
                        <th class="center">Student Name</th>
                        <th class="center">DOB</th>
                        <th class="center">Main School</th>
                        <th class="center">Main Class</th>
                        <th class="center">Centre</th>
                        <th class="center">Class</th>
                        <th class="center">Attended classes</th>
                        <th class="center">Percentage</th>
                        <!-- <th class="center">Actions</th> -->
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
<script src="{{ asset('assets/theme/js/dataTables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/dataTables/vfs_fonts.js') }}"></script>


<script src="{{ asset('assets/js/reports/index.js') }}"></script>
<script>
    

    $(document).on('change', '#filter_by_centre', function(e){  
       
      appendClasses();

    });
     function appendClasses(){
        blockScreen();
        //table.draw();    
        
        $.ajax({        
            type: 'GET',        
            url: URL + "/admin/load_classes_create",

            data: { centre : $('#filter_by_centre').val() },

            success: function (data) { 
             
            unblockScreen();  

                var $select = $('#filter_by_class');

                $select.find('option').remove();
                $.each(data.data,function(key, value)
                {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>'); // return empty
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