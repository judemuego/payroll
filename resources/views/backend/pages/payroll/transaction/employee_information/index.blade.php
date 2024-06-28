@extends('backend.master.index')

@section('title', 'EMPLOYEE INFORMATION')

@section('breadcrumbs')
    <span>TRANSACTION</span>  /  <span class="highlight">EMPLOYEE INFORMATION</span>
@endsection

@section('left-content')
    @include('backend.partial.component.tab_list', [
        'id'=>'employee_menu', 
        'data'=>array(
            array('id'=>'general', 'title'=>'GENERAL', 'icon'=>' fas fa-file-alt', 'active'=>true, 'disabled'=>false, 'function'=>true),
            array('id'=>'employment', 'title'=>'EMPLOYMENT', 'icon'=>' fas fa-portrait', 'active'=>false, 'disabled'=>true, 'function'=>true),
            array('id'=>'leaves', 'title'=>'LEAVES', 'icon'=>' fas fa-sign-out-alt', 'active'=>false, 'disabled'=>true, 'function'=>true),
            array('id'=>'work_calendar', 'title'=>'WORK CALENDAR', 'icon'=>' fas fa-calendar', 'active'=>false,'disabled'=>true, 'function'=>true),
            array('id'=>'compensation', 'title'=>'COMPENSATION, TAXES AND BENEFITS', 'icon'=>' fas fa-pager', 'active'=>false,'disabled'=>true, 'function'=>true),
        )
    ])
@endsection


@section('content')
<div class="row" style="height:100%;">
    @include('backend.partial.flash-message')
    <div class="col-12" style="height:100%;">
        <div class="tab" style="height:100%;">
            <div class="tab-content">
                <form class="form-record" method="post" id="employeeInformation">
                    @include('backend.pages.payroll.transaction.employee_information.tabs.general_tab')
                    @include('backend.pages.payroll.transaction.employee_information.tabs.employment_tab')
                    @include('backend.pages.payroll.transaction.employee_information.tabs.leaves_tab')
                    @include('backend.pages.payroll.transaction.employee_information.tabs.work_calendar_tab')
                    @include('backend.pages.payroll.transaction.employee_information.tabs.compensation_tab')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/js/backend/pages/payroll/transaction/employee_information.js"></script>
@endsection
