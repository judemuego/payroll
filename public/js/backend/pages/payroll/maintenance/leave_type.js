$(function() {
    modal_content = 'leave-types';
    module_url = '/payroll/leave-type';
    module_type = 'custom';
    page_title = 'Leave Type';

    scion.centralized_button(false, true, true, true);
    
    scion.create.table(
        'leave_types_table',  
        module_url + '/get', 
        [
            { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'/payroll/leave-type/edit/', "+ row.id + ' )"><i class="fas fa-pen"></i></a>';
                return html;
            }},
            { data: "DT_RowIndex", title:"#" },
            { data: "leave_name", title: "LEAVE NAME" },
            { data: "units", title: "UNITS" },
            { data: "normal_entitlement", title: "NORMAL ENTITLEMENT" },
            { data: "chart.account_name", title: "CHART OF ACCOUNT" },
            { data: "paid_leave", title: "PAID LEAVE" },
            { data: "show_on_payslip", title: "SHOW ON PAYSLIP" }
        ], 'Bfrtip', []
    );

});

function success() {
    switch(actions) {
        case 'save':
            break;
        case 'update':
            break;
    }
    $('#leave_types_table').DataTable().draw();
    scion.create.sc_modal('leave-types_form').hide('all', modalHideFunction);
}

function error() {
    toastr.error('Record already exist.', 'Failed')
}

function delete_success() {
    $('#leave_types_table').DataTable().draw();
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token
    };
    $.each($('#leaveTypeForm').serializeArray(), (i,v)=> {
        form_data[v.name] = v.value
    });

    return form_data;
}

function generateDeleteItems(){}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
}