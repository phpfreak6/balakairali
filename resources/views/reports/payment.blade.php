@extends('layouts.main')
@section('title')
Manage Payments
@endsection
@section('content')
<div class="row">
    <!-- <div class="col-xs-12 col-md-12">
        <div class="widget-box ui-sortable-handle" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">Payment Record Filter</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="post" id="payment_form">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" name="student_name" class="form-control input-sm" placeholder="Enter Student Name Or ID Or Parent Name" style="margin-top: 6px;">
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
                                        <select class="form-control input-sm" id="filter_by_class" style="margin-top: 6px;" name="classes">
                                            <option value="" selected="">Select Class</option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-2">
                                <select id="year" class="form-control input-sm year" name="year" style="margin-top: 6px;" required="">
                                    <option value="" selected="">Payment Year</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="term" class="form-control input-sm term" name="term" style="margin-top: 6px;" required="">
                                    <option value="">Select Term</option>
                                    @foreach($quarters as $quarter)
                                    <option value="{{ $quarter->id }}">{{ $quarter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3" style="margin-top: 6px;">
                                <label>
                                    <input name="form-field-checkbox" id="inactive_student" type="checkbox" name="inactive_student" class="ace" value="1">
                                    <span class="lbl">Inactive Student</span>
                                </label>
                            </div>
                            <div class="col-sm-3" style="margin-top: 6px;">
                                <label>
                                    <input name="form-field-checkbox" id="not_paid" type="checkbox" name="not_paid" class="ace" value="1">
                                    <span class="lbl">Not Paid for Last Term</span>
                                </label>
                            </div>
                            <div class="col-sm-2"><button type="submit" class="btn btn-sm btn-success filter_btn"><i class="fa fa-search" aria-hidden="true"></i> Filter</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    <!-- <div class="text-center form-group table-header">
        </div> -->
    <div>
        <table id="payments_datatable" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">Date</th>
                    <th class="center">Student Name</th>
                    <th class="center">Parent Email</th>
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
        var table = $('#payments_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: URL + "/admin/payment-reports/getPaymentReportsDatatable",
                type: "POST",
                data: {
                    _token: _TOKEN
                }
                // function(d) {
                // d._token = _TOKEN;
                // d.student_name = $('input[name=student_name]').val();
                // d.year = $('.year').val();
                // d.term = $('.term').val();
                // d.centre = $('#filter_by_centre').val();
                // d.classe = $('#filter_by_class').val();
                // d.inactive = $('#inactive_student:checked').val();
                // d.not_paid = $('#not_paid:checked').val();
                // }
            },
            columns: [{
                    'className': 'text-center',
                    data: 'created_at'
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
                    data: 'pay_term'
                },
                {
                    'className': 'text-center',
                    data: 'pay_year'
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
<!-- <script src="{{ asset('assets/js/reports/index.js') }}"></script> -->
@endsection