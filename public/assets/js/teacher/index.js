$(document).ready(function () {
    //var status = $('#status').val();
    var table = $('#teachers_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + '/admin/teachers-list',
            type: "POST",
            data: function(d) {                    
                d._token = _TOKEN;                    
                d.centre = $('#filter_by_centre').val();                                      
            }
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center', data: 'email'},
            {'className': 'text-center', data: 'mobile'},
            {'className': 'text-center', data: 'centre'},
            {'className': 'text-center', data: 'classes'},
            {'className': 'text-center', data: 'status'},
            {'className': 'text-center', data: 'actions', orderable: false, sortable: false, searchable: false}
        ]
    });

    $(document).on('click', '#by_centre_btn', function(e){ 

        e.preventDefault();        
        table.draw();
    });
});






