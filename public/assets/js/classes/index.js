$(document).ready(function () {
    //var status = $('#status').val();
    var table = $('#classes_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + '/admin/classes-list',
            type: "POST",
            data: function(d) {                    
                d._token = _TOKEN;                    
                d.centre = $('#filter_by_centre').val();                                      
            }
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'centre_name'},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center classes_actions', data: 'actions', orderable: false, sortable: false, searchable: false}
        ]
    });

    $(document).on('click', '#by_centre_btn', function(e){ 

        e.preventDefault();        
        table.draw();
    });
});