$(document).ready(function () {
    var table = $('#students_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + "/admin/students-list",
            type: "POST",
            data: function (d) {
                d._token = _TOKEN;
                d.centre = $('#filter_by_centre').val();
                d.classe = $('#filter_by_class').val();
                d.status = $('#status').val();
            }
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center', data: 'centre'},
            {'className': 'text-center', data: 'classes'},
            {'className': 'text-center', data: 'parent1'},
            {'className': 'text-center', data: 'p1_mobile'},
            {'className': 'text-center', data: 'p1_email'},
            {'className': 'text-center', data: 'status'},
            {'className': 'text-center students_actions', data: 'actions', orderable: false, sortable: false, searchable: false}
        ]
    });

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
            data: function (d) {
                d._token = _TOKEN;
                d.centre = $('#filter_by_centre').val();
                d.class = $('#filter_by_class').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
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
        ]
    });

    $(document).on('submit', '#signin_form', function (e) {
        e.preventDefault();
        table1.draw();
    });

    $(document).on('click', '#student_filter_btn', function (e) {
        e.preventDefault();
        table.draw();
    });

    $(document).on('change', '#filter_by_centre', function (e) {
        blockScreen();
        $.ajax({
            type: 'GET',
            url: URL + "/admin/load_classes",
            data: {centre: $('#filter_by_centre').val(), class: $('#filter_by_class').val()},
            success: function (data) {
                unblockScreen();
                if (data == false) {
                    return false;
                }
                $('.classes_append').html(data);
            },
        });
    });
});

$(document).on('click', 'tbody .markaspaid', function () {
    var row = $('#students_datatable').DataTable().row($(this).closest('tr')).data();
    $('#markPaidLabel').text('Payment for ' + row.first_name);
    $('#hidPayStdId').val(row.id);
    $('#markPaidModal').modal('show');
});

function paid(id) {
    $.ajax({
        type: 'POST',
        url: URL + "/admin/student/mark-paid",
        data: {hidPayStdId: id, _token: _TOKEN},
        success: function (data) {
            $('#markPaidModal').modal('hide');
            unblockScreen();
            if (data.status == 'paid') {
                toastr.options = {"closeButton": true, "timeOut": 3000};
                toastr.warning(data.msg);
                return false;
            }
            toastr.options = {"closeButton": true, "timeOut": 3000};
            toastr.success('Done ! Paid.');
        },
    });
}

$(document).on('click', '.termChkbox', function () {
    $('.termChkbox').not(this).prop('checked', false);
});

$('#markPaidFormm').on('submit', function (e) {
    e.preventDefault();
    blockScreen();
    $.ajax({
        type: 'POST',
        url: URL + "/admin/student/mark-paid",
        data: $(this).serialize(),
        success: function (data) {
            $('#markPaidModal').modal('hide');
            unblockScreen();
            if (data.status == 'paid') {
                toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
                toastr.warning(data.msg);
                return false;
            }
            toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
            toastr.success('Done ! Paid.');
        }
    });
});

