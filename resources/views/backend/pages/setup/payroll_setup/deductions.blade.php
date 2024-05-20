@extends('backend.master.index')

@section('title', 'DEDUCTIONS')

@section('breadcrumbs')
    <span>SETUP / PAYROLL</span> / <span class="highlight">DEDUCTIONS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">DEDUCTIONS: MAINTENANCE SCREEN</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="deductions_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="deductions_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('deductions_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="deductionsForm" class="form-record">
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
                            <option value="1">TAX SENSITIVE</option>
                            <option value="0">NON-TAX SENSITIVE</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 type">
                        <label>TYPE</label>
                        <select name="type" id="type" class="form-control">
                            <option value="deductions">DEDUCTIONS</option>
                            <option value="non-deductions">NON-DEDUCTIONS</option>
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
    <script src="/js/backend/pages/payroll/maintenance/deductions.js"></script>
@endsection