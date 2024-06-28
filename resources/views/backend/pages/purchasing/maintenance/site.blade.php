@extends('backend.master.index')

@section('title', 'SITE')

@section('breadcrumbs')
    <span>MAINTENANCE</span> / <span class="highlight">SITE</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">SITE: MAINTENANCE SCREEN</h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="sites_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="sites_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('benefits_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form method="post" id="classForm" class="form-record">
                <div class="row">
                    <div class="form-group col-md-12 project_name">
                        <label>Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name"/>
                    </div>

                    <div class="form-group col-md-12 location">
                        <label>Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Project Location"/>
                    </div>

                    <div class="form-group col-md-12 person_in_charge">
                        <label>Project in Charge</label>
                        <input type="text" class="form-control" id="person_in_charge" name="person_in_charge" placeholder="Person in Charge"/>
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
    <script src="/js/backend/pages/purchasing/maintenance/sites.js"></script>
@endsection
