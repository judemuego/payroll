@extends('backend.master.index')

@section('title', 'BENEFITS')

@section('breadcrumbs')
    <span>MAINTENANCE</span> / <span class="highlight">BENEFITS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">BENEFITS: MAINTENANCE SCREEN</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="benefits_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>BENEFITS</th>
                                <th>DESCRIPTION</th>
                                <th>CHART</th>
                                <th>ACCOUNT</th>
                                {{-- <th>TYPE</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="benefits_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('benefits_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="benefitsForm" class="form-record">
                <div class="row">
                    <div class="form-group col-md-12 benefits">
                        <label>BENEFITS</label>
                        <input type="text" class="form-control" id="benefits" name="benefits" placeholder="BENEFITS"/>
                    </div>
                    <div class="form-group col-md-12 description">
                        <label>DESCRIPTION</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="DESCRIPTION"/>
                    </div>
                    {{-- <div class="form-group col-md-12 account">
                        <label>ACCOUNT</label>
                        <input type="text" class="form-control" id="account" name="account" placeholder="ACCOUNT"/>
                    </div> --}}
                    <div class="form-group col-md-12 chart_id">
                        <label>CHART OF ACCOUNT</label>
                        <select name="chart_id" id="chart_id" class="form-control">
                            <option value=""></option>
                            @foreach ($record as $item)
                            <option value="{{$item->id}}">{{$item->account_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12 type">
                        <label>TYPE</label>
                        <select name="type" id="type" class="form-control">
                            <option value=""></option>
                            <option value="government_mandated">GOVERNMENT MANDATED BENEFITS</option>
                            <option value="other">OTHER BENEFITS</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="/js/backend/pages/payroll/maintenance/benefits.js"></script>
@endsection