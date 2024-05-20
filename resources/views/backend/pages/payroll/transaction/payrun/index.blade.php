@extends('backend.master.index')

@section('title', 'PAYRUN')

@section('breadcrumbs')
    <span>TRANSACTION / PAYROLL</span>  /  <span class="highlight">PAYRUN</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">PAYRUN LIST</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="payrun_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="payrun_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('payrun_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="payrunForm" class="form-record">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="payment_schedule">PAYMENT SCHEDULE</label>
                            <select name="payment_schedule" id="payment_schedule" class="form-control" onchange="selectPaymentSchedule()">
                                <option value="" style="display:none;">PLEASE SELECT PAYMENT SCHEDULE</option>
                                <option value="weekly">WEEKLY</option>
                                <option value="bimonthly">BI-MONTHLY</option>
                                <option value="monthly">MONTHLY</option>
                                <option value="custom">CUSTOM</option>
                            </select>
                        </div>
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
<script src="/js/backend/pages/payroll/transaction/payrun.js"></script>
@endsection
