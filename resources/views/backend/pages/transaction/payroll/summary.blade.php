@extends('backend.master.index')

@section('title', 'PAYROLL SUMMARY')

@section('breadcrumbs')
    <span>TRANSACTION </span> / <span class="highlight">PAYROLL</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">PAYROLL SUMMARY</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <h3>CURRENT PAYROLL</h3>
                    <table id="payroll_summary_table" class="table table-striped" style="width:100%"></table>
                    <h3>PAYROLL HISTORY</h3>
                    <table id="payroll_history_table" class="table table-striped" style="width:100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
<div class="sc-modal-content" id="payroll_summary_form">
    <div class="sc-modal-dialog sc-xl">
        <div class="sc-modal-header">
            <span class="sc-title-bar">Payroll Details</span>
            <span class="sc-close" onclick="scion.create.sc_modal('payroll_summary_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="timeLogsForm" class="form-record">
                <div class="row">
                    <div class="col-12 mb-3">
                        <button class="btn btn-sm btn-warning sent-email"><i class="fas fa-envelope"></i> SEND PAYSLIP</button>
                        <h5><b>PAYROLL SCHEDULE: </b><span id="payroll_period"></span></h5>
                    </div>
                    <div class="col-12">
                        <div class="overall_label">OVERALL TOTAL</div>
                        <table id="overallTotal">
                            <thead>
                                <th>GROSS EARNING</th>
                                <th>SSS</th>
                                <th>PAG-IBIG</th>
                                <th>PHILHEALTH</th>
                                <th>TAX</th>
                                <th>NETPAY</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="total_gross">-</td>
                                    <td id="total_sss">-</td>
                                    <td id="total_pagibig">-</td>
                                    <td id="total_philhealth">-</td>
                                    <td id="total_tax">-</td>
                                    <td id="total_netpay">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <table id="payroll_details_table" class="table table-striped" style="width:100%"></table>
            </form>
        </div>
    </div>
</div>

<div class="sc-modal-content" id="approval_confirmation">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar">COMPLETE SEQUENCE: <b class="sequence_no_disp"></b></span>
            <span class="sc-close" onclick="scion.create.sc_modal('approval_confirmation').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <div class="message">
                ARE YOU SURE YOU WANT TO COMPLETE THIS PAYROLL?
            </div>
        </div>
        <div class="sc-modal-footer">
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-sm btn-success positive-button">YES</button>
                    <button class="btn btn-sm btn-danger negative-button">NO</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sc-modal-content" id="payslip_form">
    <div class="sc-modal-dialog sc-xl">
        <div class="sc-modal-header">
            <span class="sc-title-bar">Payslip</span>
            <span class="sc-close" onclick="scion.create.sc_modal('payslip_form').hide('', custom_modalHide)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body" id="print_payslip">
            <div class="employee-details row">
                <div class="col-6">
                    <table class="employee-info-tbl">
                        <thead>
                            <th>EMPLOYEE INFORMATION</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b>FULL NAME:</b> <span id='t-full_name'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>ADDRESS:</b> <span id='t-address'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>CONTACT #:</b> <span id='t-contact'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>EMAIL:</b> <span id='t-email'></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 payroll-details">
                    <table>
                        <thead>
                            <th>PAY DATE</th>
                            <th>PAY TYPE</th>
                            <th>PERIOD</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="paydate">-</td>
                                <td id="paytype">-</td>
                                <td id="period">-</td>
                            </tr>
                        </tbody>
                        <thead>
                            <th>SEQUENCE #</th>
                            <th>PAYMENT METHOD</th>
                            <th>NETPAY</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="sequence">-</td>
                                <td id="paymentmethod">-</td>
                                <td id="netpay">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="earnings">
                <table>
                    <thead>
                        <th>EARNINGS</th>
                        <th>RATE</th>
                        <th>HOURS</th>
                        <th class="text-right">TOTAL</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><button class="btn btn-sm btn-primary" id="add_earnings">ADD EARNINGS</button></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" style="font-weight:bold;">TOTAL GROSS EARNINGS</td>
                            <td class="text-right total">-</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id="deductions">
                <h3>DEDUCTIONS</h3>
                <table id="mandated">
                    <thead>
                        <th colspan="2">MANDATED BENEFITS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>SSS</b></td>
                            <td id="sss" class="text-right">-</td>
                        </tr>
                        <tr>
                            <td><b>PHILHEALTH</b></td>
                            <td id="philhealth" class="text-right">-</td>
                        </tr>
                        <tr>
                            <td><b>PAG-IBIG</b></td>
                            <td id="pagibig" class="text-right">-</td>
                        </tr>
                    </tbody>
                </table>
                <table id="other">
                    <thead>
                        <th colspan="2">OTHER BENEFITS</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><button class="btn btn-sm btn-primary" id="add_deductions">ADD DEDUCTIONS</button></td>
                        </tr>
                        <tr>
                            <td>TOTAL DEDUCTIONS</td>
                            <td class="text-right total">2300</td>
                        </tr>
                        <tr>
                            <td>TAXABLE AMOUNT</td>
                            <td class="text-right" id="taxable-amount">-</td>
                        </tr>
                        <tr>
                            <td>WITHHOLDING TAX</td>
                            <td class="text-right" id="withholding-tax">-</td>
                        </tr>
                        <tr class="t-net-pay">
                            <td>NET PAY</td>
                            <td class="text-right" id="net-pay">-</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="sc-modal-content" id="add_details">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('add_details').hide('', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="detailsForm" class="form-record">
                <div class="form-group col-md-12 type">
                    <label>EARNING TYPE</label>
                    <select name="type" id="type" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-12 amount">
                    <label>AMOUNT</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="0" min="0"/>
                </div>
            </form>
        </div>
    </div>
</div>
@parent
@endsection
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="/js/backend/pages/transaction/payroll_summary.js"></script>
@endsection

@section('styles-2')
    <link href="{{asset('/css/custom/payroll_summary.css')}}" rel="stylesheet">
@endsection