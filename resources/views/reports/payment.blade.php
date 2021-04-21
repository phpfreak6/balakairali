@extends('layouts.main')
@section('title')
Manage Payments
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <!-- <h5 class="widget-title">Payment Record Filter</h5> -->
                <form method="GET" id="payment_filter">
                    <div class="row">
                        <div class="col-sm-2">
                            <?= Form::label('centre', 'Centre', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('centre', $centresDropdownArr, $centre, ['id' => 'centre', 'class' => 'form-control input-sm', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Form::label('class', 'Class', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('classes', $classesDropdownArr, $class, ['id' => 'classes', 'class' => 'form-control input-sm', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Form::label('pay_year', 'Year', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('pay_year', ['' => 'Payment Year', '2021' => '2021', '2022' => '2022', '2023' => '2023', '2024' => '2024'], $pay_year, ['id' => 'pay_year', 'class' => 'form-control input-sm year', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Form::label('pay_term', 'Term', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('pay_term', $termsDropdownArr, $pay_term, ['id' => 'pay_term', 'class' => 'form-control input-sm term', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Form::label('payment_status', 'Payment Status', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('payment_status', ['1' => 'Paid', '2' => 'Unpaid'], $payment_status ?? 1, ['id' => 'payment_status', 'class' => 'form-control input-sm payment_status', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Form::label('student_status', 'Student Status', ['class' => 'form-label text-primary']) ?>
                            <?= Form::select('student_status', ['1' => 'Active', '0' => 'Inactive', '3' => 'All'], $student_status ?? 1, ['id' => 'student_status', 'class' => 'form-control input-sm student_status', 'style' => 'margin-top: 6px;']) ?>
                        </div>
                        <div class="col-sm-2">
                            <button style="margin-top: 6px;" type="submit" class="btn btn-sm btn-success filter_btn"><i class="fa fa-search" aria-hidden="true"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <table id="payments_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Date</th>
                        <th class="center">Student Name</th>
                        <th class="center">Parent Email</th>
                        <th class="center">Centre</th>
                        <th class="center">Class</th>
                        <th class="center">Term</th>
                        <th class="center">Year</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?= getDatatableResources() ?>
<script>
    function getPaymentReportsDatatable() {
        var centre = $('#centre').val();
        var classes = $('#classes').val();
        var pay_term = $('#pay_term').val();
        var pay_year = $('#pay_year').val();
        var payment_status = $('#payment_status').val();
        var student_status = $('#student_status').val();
        var table = $('#payments_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: URL + "/admin/payment-reports/getPaymentReportsDatatable",
                type: "POST",
                data: {
                    _token: _TOKEN,
                    centre: centre,
                    classes: classes,
                    pay_term: pay_term,
                    pay_year: pay_year,
                    payment_status: payment_status,
                    student_status: student_status
                }
            },
            columns: [{
                    'className': 'text-center',
                    data: 'payment_date'
                },
                {
                    'className': 'text-center',
                    data: 'combined_name'
                },
                {
                    'className': 'text-center',
                    data: 'p1_email'
                },
                {
                    'className': 'text-center',
                    data: 'centre_name'
                },
                {
                    'className': 'text-center',
                    data: 'class_name'
                },
                {
                    'className': 'text-center',
                    data: 'pay_term',
                    "defaultContent": 'N/A'
                },
                {
                    'className': 'text-center',
                    data: 'pay_year',
                    "defaultContent": 'N/A'
                }
            ]
        });
    }

    $(document).ready(function() {
        getPaymentReportsDatatable();
    });

    $(document).on('submit', '#payment_form', function(e) {
        e.preventDefault();
        table.draw();
    });
</script>
@endsection