@extends('backend.master.index')

@section('title', 'TIME LOGS')

@section('breadcrumbs')
    <span>TRANSACTION / TIMEKEEPING</span> / <span class="highlight">TIME LOGS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">TIME LOGS</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select name="department" id="department" class="form-control" onchange="filter(this.value)">
                                    <option value="all">ALL DEPARTMENT</option>
                                    @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date-filter" id="date-filter" onchange="filter($('#department').val())"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 legend">
                            <div class="legend-status">
                                <span class='colors status-0'></span>
                                <span class='text-status'>DRAFT</span>
                            </div>
                            <div class="legend-status">
                                <span class='colors status-1'></span>
                                <span class='text-status'>SUBMITTED</span>
                            </div>
                            <div class="legend-status">
                                <span class='colors status-2'></span>
                                <span class='text-status'>FOR APPROVAL</span>
                            </div>
                            <div class="legend-status">
                                <span class='colors status-3'></span>
                                <span class='text-status'>APPROVED</span>
                            </div>
                            <div class="legend-status">
                                <span class='colors status-4'></span>
                                <span class='text-status'>ON-HOLD</span>
                            </div>
                            <div class="legend-status">
                                <span class='colors status-5'></span>
                                <span class='text-status'>FOR ADJUSTMENT</span>
                            </div>
                        </div>
                    </div>
                    <table id="employee_table" class="table table-striped" style="width:100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="time_logs_form">
    <div class="sc-modal-dialog sc-xl">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('time_logs_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="timeLogsForm" class="form-record">
                <div class="row">
                    <div class="col-6">
                        <h5>TIME LOGS</h5>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-success crs">MATCH TIME LOGS</button>
                    </div>
                </div>
                <table id="time_plotting" class="table table-striped" style="width:100%"></table>
            </form>
        </div>
    </div>
</div>
@endsection
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="/js/backend/pages/transaction/time_logs.js"></script>
@endsection

@section('styles-2')
    <link href="{{asset('/css/custom/time_logs.css')}}" rel="stylesheet">
@endsection
