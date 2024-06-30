@extends('backend.master.index')

@section('title', 'EARNINGS')

@section('breadcrumbs')
    <span>SETUP / PAYROLL</span> / <span class="highlight">EARNINGS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">EARNINGS: MAINTENANCE SCREEN</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="earnings_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="earnings_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('earnings_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="earningForm" class="form-record">
                <div class="row">
                    <div class="form-group col-md-9 name">
                        <label>TITLE</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="TITLE"/>
                    </div>
                    <div class="form-group col-md-3 code">
                        <label>CODE</label>
                        <input type="text" class="form-control" id="code" name="code"/>
                    </div>
                    <div class="form-group col-md-12 description">
                        <label>DESCRIPTION</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group col-md-12 multiplier">
                        <label>MULTIPLIER</label>
                        <input type="number" class="form-control" id="multiplier" name="multiplier" value="1" min="1"/>
                    </div>
                    <div class="form-group col-md-6 taxable">
                        <label>TAXABLE</label>
                        <select name="taxable" id="taxable" class="form-control">
                            <option value="1">TAXABLE</option>
                            <option value="0">NON-TAXABLE</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 type">
                        <label>TYPE</label>
                        <select name="type" id="type" class="form-control">
                            <option value="earning">EARNING</option>
                            <option value="non-earning">NON-EARNING</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 chart_id">
                        <label>CHART OF ACCOUNT</label>
                        <select name="chart_id" id="chart_id" class="form-control">
                            <option value=""></option>
                            @foreach ($record as $item)
                            <option value="{{$item->id}}">{{$item->account_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12 status">
                        <label>STATUS</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
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
    <script src="/js/backend/pages/payroll/maintenance/earnings.js"></script>
@endsection