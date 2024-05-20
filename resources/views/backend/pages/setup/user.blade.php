@extends('backend.master.index')

@section('title', 'User')

@section('breadcrumbs')
    <span>Account</span> / <span class="highlight">User</span>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">User Screen
                    <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#classModal" style="float:right">
                        Add User
                    </button>
                </h5>
            </div>
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="datatables" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Profile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="save_record" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                        @csrf
                    <div class="form-group col-md-12">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Profile Picture</label>
                        <input type="text" class="form-control" id="profile_img" name="profile_img" placeholder="Profile Picture" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-check">
                            <input class="form-check-input" id="status" name="status" value="0" type="checkbox" onchange="checkVal(this.id)">
                            <span class="form-check-label">
                            Active
                            </span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- MODAL --}}
                    
                    
    @stop

    @section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        var deleteClasses=null;
        $(function() {
            $('#datatables').DataTable({
                responsive: true, 
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/settings/users/get",
                    type: "GET"
                },
                columns: [
                    { data: "DT_RowIndex", title:"#" },
                    { data: "id", title:"Action", render: function(data, type, row, meta) {
                        var html = "";
                        html += '<a href="#" class="align-middle edit" onclick="edit(' + row.id + ')" title="Edit" data-toggle="modal" data-target="#classModal"><i class="fas fa-pen"></i></a>';
                        html += '<a href="#" onclick="deleteRecord(' + row.id+ ')"><i class="align-middle fas fa-fw fa-trash"></i></a>';
                        return html;
                    }},
                    { data: "id", title:"Full Name", render: function(data, type, row, meta) {
                        var html = row.firstname + ' ' + row.middlename + ' ' + row.lastname;
                        return html;
                    }},
                    { data: "email", title: "Email" },
                    { data: "profile_img", title: "Profile Picture" },
                    { data: "status", title:"Status", render: function(data, type, row, meta) {
                        if(row.status == 1){
                            return '<span class="badge badge-success">Active</span>';
                        } else {
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                    }}
                ]
            });

            $('.add').click(function(){
                $('.modal-title').text('Add User');
                $('.submit-button').text('Add');
                $('#save_record')[0].reset();
                record_id = null;
            });

            $('#save_record').validate({
                submitHandler: function (form) {
                    var formData = $("#save_record").serialize();

                    if(record_id === null) {
                        scion.record.add('/settings/users/save', formData,
                        function() {
                            $('#datatables').DataTable().draw();
                            $('#classModal').modal('hide');
                        });
                    }
                    else {
                        scion.record.update('/settings/users/update', record_id, formData,
                        function() {
                            $('#datatables').DataTable().draw();
                            $('#classModal').modal('hide');
                        },
                        function() {});
                    }

                    return false;
                }
            });
        });
        

        function edit(id){
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/settings/users/edit/' + id,
                method: 'get',
                data: {},
                success: function(data) {
                    $('.modal-title').text('Update User');
                    $('.submit-button').text('Update');
                    $('#save_record')[0].reset();
                    record_id = id;

                    $.each(data, function() {
                        $.each(this, function(k, v) {
                            if(k === "status"){
                                if(v == 1) {
                                    console.log(k + ' ' + v);
                                    $("#"+k).prop('checked', true);
                                }
                            }
                            $('#'+k).val(v);
                        });
                    });
                }
            });
        }

        function checkVal(id) {
            if($('#'+id).prop('checked') === true) {
                $('#'+id).val('1');
            }
            else {
                $('#'+id).val('0')
            }
        }

        function deleteRecord(id) {
            delete_func = scion.record.delete('/settings/users/destroy', id,
            function() {
                $('#datatables').DataTable().draw();
            },
            function() {
                console.log('error');
            });
        }
        
    </script>
@endsection