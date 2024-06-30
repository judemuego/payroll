@extends('backend.master.index')

@section('title', 'PURCHASE ORDER')

@section('breadcrumbs')
    <span>TRANSACTION</span>  /  <span class="highlight">PURCHASE ORDER</span>
@endsection

@section('left-content')
    @include('backend.partial.component.tab_list', [
        'id'=>'employee_menu',
        'data'=>array(
            array('id'=>'preparation', 'title'=>'PREPARATION', 'icon'=>' fas fa-file-alt', 'active'=>true, 'disabled'=>false, 'function'=>true),
            array('id'=>'review', 'title'=>'REVIEW', 'icon'=>' fas fa-portrait', 'active'=>false, 'disabled'=>false, 'function'=>true),
            array('id'=>'approval', 'title'=>'APPROVAL', 'icon'=>' fas fa-portrait', 'active'=>false, 'disabled'=>false, 'function'=>true),
            array('id'=>'recieved', 'title'=>'RECEIVING', 'icon'=>' fas fa-portrait', 'active'=>false, 'disabled'=>false, 'function'=>true),
        )
    ])
@endsection


@section('content')
<div class="row" style="height:100%;">
    <div class="col-12" style="height:100%;">
        <div class="tab" style="height:100%;">
            <div class="tab-content">
                <form class="form-record" method="post" id="employeeInformation">
                    @include('backend.pages.purchasing.transaction.purchase_order.tabs.preparation')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/js/backend/pages/purchasing/transaction/purchase_order.js"></script>
@endsection
