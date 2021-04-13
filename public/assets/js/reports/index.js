$(document).ready(function () {
    var table = $('#payments_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL + "/admin/payment/report",
            type: "POST",
            data: function (d) {
                d._token = _TOKEN;
                d.student_name = $('input[name=student_name]').val();
                d.year = $('.year').val();
                d.term = $('.term').val();
                d.centre = $('#filter_by_centre').val();
                d.classe = $('#filter_by_class').val();
                d.inactive = $('#inactive_student:checked').val();
                d.not_paid = $('#not_paid:checked').val();
            }
        },
        columns: [
            {'className': 'text-center', data: 'date'},
            {'className': 'text-center', data: 'id'},
            {'className': 'text-center', data: 'student_name'},
            {'className': 'text-center', data: 'parent_email'},
            {'className': 'text-center', data: 'payment_details'},
        ]
    });

    var table_a = $('#attendance_datatable').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfrtip',
        buttons: [
            {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i> <span class=''>CSV</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf-o bigger-110 orange'></i> <span class=''>PDF</span>",
                "className": "btn btn-white btn-primary btn-bold",
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                text: "<button class='btn btn-white btn-primary btn-bold'><i class='fa fa-envelope bigger-110 orange'></i> <span class=''>Send File to Admin</span></button>",
                action: function (e, dt, node, config) {
                    sendMail();
                }
            }
        ],
        ajax: {
            url: URL + "/admin/attendance/report",
            type: "POST",
            data: function (d) {
                d._token = _TOKEN;
                d.student_name = $('input[name=student_name]').val();
                d.year = $('.year').val();
                d.term = $('.term').val();
                d.centre = $('#filter_by_centre').val();
                d.classe = $('#filter_by_class').val();
            }
        },
        columns: [
            {'className': 'text-center', data: 'DT_RowIndex', orderable: false, sortable: false, searchable: false},
            {'className': 'text-center', data: 'name'},
            {'className': 'text-center', data: 'dob'},
            {'className': 'text-center', data: 'main_school'},
            {'className': 'text-center', data: 'main_class'},
            {'className': 'text-center', data: 'centre'},
            {'className': 'text-center', data: 'class'},
            {'className': 'text-center', data: 'no_of_attended_classes'},
            {'className': 'text-center', data: 'percentage'}
        ]
    });

    $(document).on('submit', '#payment_form', function (e) {
        e.preventDefault();
        table.draw();
    });

    $(document).on('submit', '#filter_form', function (e) {
        e.preventDefault();
        totalClasses();
        table_a.draw();
    });

    function totalClasses() {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: URL + "/admin/attendance/totalClasses",
            type: 'POST',
            data: {
                year: $('.year').val(),
                term: $('.term').val()
            },
            success: function (data) {
                $('#total_classes').html('<strong>Total Classes : ' + data + '</strong>');
            }
        });
    }

    $(document).on('click', '.mail_invoice', function () {
        blockScreen();
    });


    function sendMail() {
        blockScreen();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: URL + "/admin/attendance/report",
            type: 'POST',
            data: {
                student_name: $('input[name=student_name]').val(),
                year: $('.year').val(),
                term: $('.term').val(),
                mail: 'true'

            },
            success: function (data) {
                unblockScreen()
                if (data == 'success') {
                    toastr.options = {"closeButton": true};
                    toastr.success('Mail Sent.');
                } else if (data == 'error') {
                    toastr.options = {"closeButton": true};
                    toastr.error('Mail not Sent. Try again');
                }
            }
        });
    }
});