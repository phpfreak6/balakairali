$(document).ready(function () {
    //var status = $('#status').val();
    var table = $('#resource_datatable').DataTable({
        processing: true,
        serverSide: true,
       
        ajax: {
            url: URL + "/admin/fetch-resources",
            type: "POST",
           data: function(d) {
                    d._token = _TOKEN;
                    d.file_type = $('#file_search').val();
                  
                  }
        },
        columns: [
            //{'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'title'},
            {'className': 'text-center', data: 'file_name'},
            {'className': 'text-center', data: 'mime_type'},
            {'className': 'text-center', data: 'actions', orderable: false, sortable: false, searchable: false}

        ]
    });

    
    

    /**************************************************************************************/
    var table1 = $('#login_datatable').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfrtip',
        buttons: [
                      
          {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class=''>Export</span>",
            "className": "btn btn-white btn-primary btn-bold"
          },
          
         
        ],

        ajax: {
            url: URL + "/admin/signin-signout",
            type: "POST",
           data: function(d) {
                    d._token = _TOKEN;
                    d.centre = $('#centre_filter').val();
                  
                  }
        },
        columns: [
            
            {'className': 'text-center', data: 'date'},
            {'className': 'text-center', data: 'user_id'},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center', data: 'class'},
            {'className': 'text-center', data: 'login_time'},
            {'className': 'text-center', data: 'logout_time'},
            {'className': 'text-center', data: 'duration'},
            // {'className': 'text-center', data: 'actions', orderable: false, sortable: false, searchable: false}
        ]
    });


$(document).on('submit', '#resou_form', function(e){
        e.preventDefault();
        table.draw();
});


$('#markPaidFormm').on('submit', function(e) {      
    e.preventDefault(); 

    blockScreen();

     $.ajax({
        type: 'POST',
        url: URL + "/admin/student/mark-paid",
        data: $(this).serialize(),
        success: function (data) {
        $('#markPaidModal').modal('hide');
         unblockScreen();
         toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
         toastr.success('Done ! Paid.');
           //alert();
        },
    });

});
});

