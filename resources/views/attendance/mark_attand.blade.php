@extends('layouts/main')
@section('title')
Manage Centres
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            <a href="{{ route('admin.centre.create') }}" class="btn btn-success btn-sm"><i class="glyphicon-plus glyphicon"></i> Add</a>
        </div>
        <div>
            <table id="centres_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">ID</th>
                        <th class="center">Name</th>
                        <th class="center">Father Name</th>
                        <th class="center">Mobile</th>
                        <th class="center">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?= getDatatableResources() ?>
<script src="{{ asset('assets/js/centre/index.js') }}"></script>
@endsection