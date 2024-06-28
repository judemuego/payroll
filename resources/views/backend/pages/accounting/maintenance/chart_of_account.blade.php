@extends('backend.master.index')

@section('title', 'CHART OF ACCOUNTS')

@section('breadcrumbs')
    <span>MAINTENANCE</span> / <span class="highlight">CHART OF ACCOUNTS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">CHART OF ACCOUNTS: MAINTENANCE SCREEN</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="account_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="chart_of_accounts_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('chart_of_accounts_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="classForm" class="form-record">
                <div class="row">
                    <div class="form-group col-md-12 account_number">
                        <label>Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number"/>
                    </div>

                    <div class="form-group col-md-12 account_name">
                        <label>Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name"/>
                    </div>

                    <div class="form-group col-md-12 account_type">
                        <label>Account Type</label>
                        <select name="account_type" id="account_type" class="form-control">
                            @foreach ($account_types as $account_type)
                                <option value="{{ $account_type->id }}">{{ $account_type->account_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12 description">
                        <label>Description</label>
                        <input type="text" class="form-control" id="description" name="description"/>
                    </div>

                    <div class="form-group col-md-12 normal_balance">
                        <label>Account Type</label>
                        <select name="normal_balance" id="normal_balance" class="form-control">
                            <option value="CREDIT">CREDIT</option>
                            <option value="DEBIT">DEBIT</option>
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
    <script src="/js/backend/pages/accounting/maintenance/chart_of_account.js"></script>
@endsection
