$(function() {
    modal_content = 'sites';
    module_url = '/purchasing/sites';
    module_type = 'custom';
    page_title = "Sites";

    scion.centralized_button(false, true, true, true);
    scion.create.table(
        'sites_table',
        module_url + '/get',
        [
            { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'/purchasing/sites/edit/', "+ row.id +')"><i class="fas fa-pen"></i></a>';
                return html;
            }},
            { data: "DT_RowIndex", title:"#" },
            { data: "project_name", title: "Project Name" },
            { data: "location", title: "Location" },
            { data: "person_in_charge", title: "Person in Charge" }
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
    $('#sites_table').DataTable().draw();
    scion.create.sc_modal('benefits_form').hide('all', modalHideFunction)
}

function error() {}

function delete_success() {
    $('#sites_table').DataTable().draw();
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token,
        project_name: $('#project_name').val(),
        location: $('#location').val(),
        person_in_charge: $('#person_in_charge').val(),
    };

    return form_data;
}

function generateDeleteItems(){}


function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
}
