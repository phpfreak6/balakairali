@extends('layouts/main')
@section('title')
Manage Students
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            <div class="row">
                <div class="col-sm-2">
                    @permission('editing_teacher')
                    <a href="{{ route('admin.student.create') }}" class="btn btn-success btn-sm"><i class="glyphicon-plus glyphicon"></i> Add</a>
                    @endpermission
                </div>
                <div class="col-sm-2">
                    <select id="filter_by_centre" class="form-control input-sm year" name="centre" style="margin-top: 6px;" required="">
                        <option value="">Select Center</option>
                        @foreach($centres as $centre)
                        <option value="{{ $centre->id }}">{{ $centre->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 classes_append">
                    <select id="filter_by_class" class="form-control input-sm term" name="classe" style="margin-top: 6px;" required="">
                        <option value="">Select Class</option>
                        @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <?= Form::select('status', ['' => 'By Status', '0' => 'Inactive', '1' => 'Active'], '', ['style' => 'margin-top: 6px;', 'class' => 'input-sm form-control', 'id' => 'status']) ?>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-success btn-sm" id="student_filter_btn">Filter</button>
                </div>
            </div>
        </div>
        <div>
            <table id="students_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">ID</th>
                        <th class="center">Name</th>
                        <th class="center">Centre</th>
                        <th class="center">Class</th>
                        <th class="center">Parent1 Name</th>
                        <th class="center">Parent1 Mobile</th>
                        <th class="center">Parent1 Email</th>
                        <th class="center">Status</th>
                        <th class="center">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade in" id="markPaidModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                <h4 class="modal-title" id="markPaidLabel">Payment for Joseph</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="markPaidFormm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mPaidYear">Select Year:</label>
                                <select id="mPaidYear" name="mPaidYear" class="form-control">
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mPaidTerm">Select Term:</label>
                                <div class="checkbox">
                                    @foreach($quarters as $quarter)
                                    <label class="checkbox-inline"><input type="checkbox" name="mPaidTerm" class="termChkbox" value="{{ $quarter->id }}"> {{ $quarter->name }}</label>
                                    @endforeach
                                    <label class="checkbox-inline"><input type="checkbox" name="mPaidTerm" class="termChkbox" value="full_year"> Full Year</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-lg btn-success">Mark Paid</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="hidPayStdId" id="hidPayStdId" value="">
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .dt-button{
        background-color: #629b58 !important;
        border-color: #87b87f;
        color:white !important;
    }
</style>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<?= getDatatableResources() ?>
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/student/index.js') }}"></script>
@endsection