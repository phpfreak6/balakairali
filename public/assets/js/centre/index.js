function getCentresDatatable() {
    //var status = $('#status').val();
    var table = $('#centres_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + "/admin/centres-list",
            type: "POST",
            data: {_token: _TOKEN}
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center', data: 'address'},
            {'className': 'text-center centres_actions', data: 'actions', orderable: false, sortable: false, searchable: false}
        ]
    });
}

$(document).ready(function () {
    getCentresDatatable();
});