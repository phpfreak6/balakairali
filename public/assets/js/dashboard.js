$(document).ready(function () {
    var table = $('#dashboard_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + '/admin/dashboard',
            type: "POST",
             data: function(d) {                    
                d._token = _TOKEN;                                                    
            }
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'centre_name'},
            {'className': 'text-center', data: 'active_teachers'},
            {'className': 'text-center', data: 'active_students'},
            // {'className': 'text-center', data: 'attendance_percentage'}
            
        ]
    });
});