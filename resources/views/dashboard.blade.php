@extends('layouts/main')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 infobox-container">
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-university"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number">{{ \App\Models\Centre::count() }}</span>
                <div class="infobox-content">Total Centres</div>
            </div>
        </div>
        <div class="infobox infobox-orange2">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-user"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number">{{ \App\Models\User::totalTeacher() }}</span>
                <div class="infobox-content">Total Teachers</div>
            </div>
        </div>
        <div class="infobox infobox-purple">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-graduation-cap"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number">{{ \App\Models\User::totalStudent() }}</span>
                <div class="infobox-content">Total Students</div>
            </div>
        </div>
        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-dollar"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number">{{ \App\Models\User::notPaidTotalCount() }}</span>
                <div class="infobox-content">Not Paid Last Term</div>
            </div>
        </div>
    </div>
</div>
<div class="space-10" ></div>
<div class="row">
    <div class="page-header">
        <h1>
            <i class="ace-icon fa fa-rss orange"></i> Snapshot
        </h1>
    </div>
    <div class="col-xs-12">
        <div class="table-header">
            <div class="row">			    
            </div>
        </div>
        <div>
            <table id="dashboard_datatable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">S.No.</th>
                        <th class="center">Centres</th>
                        <th class="center">Active Teachers</th>
                        <th class="center">Active Students</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<?= getDatatableResources() ?>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection