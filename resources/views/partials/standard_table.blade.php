<div class="table-header">
      <div class="text-center form-group table-header">
            <div class="row">
                <form method="post" id="resou_form" action="" >
                    @csrf
                <div class="col-sm-1"><label for="">Filter : </label> </div>
             
                 <div class="col-sm-3">
                     <select class="form-control multiselect" id="file_search" name="file_search" >
                        <option value="" >Select Type</option>
                        <option value="standard_document">Standard Document</option>
                        <option value="syllabus">Syllabus</option>
                        <option value="test_format">Test Format</option>
                           
                    </select>   
                </div> 
                    
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-sm btn-success filter_btn">Filter</button>
                </div>

                <div class="col-sm-2"></div>
            </form>
            </div>
        </div>              
</div>
<table id="resource_datatable" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">Title</th>
            <th class="center">File</th>
            <th class="center">Mime</th>
            <th class="center">Actions</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>