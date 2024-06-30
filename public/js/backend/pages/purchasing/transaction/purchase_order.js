$(function() {
    module_content = 'purchase_orders';
    module_url = '/purchasing/purchase_order';
    tab_active = 'preparation';
    page_title = "";
    actions = 'save';
    module_type = 'transaction';
    modal_content = '';

    scion.centralized_button(false, true, true, true);
    scion.action.tab(tab_active);

    preparation_func();
});


// DEFAULT FUNCTION
function success(record) {
    switch(actions) {
        case 'save':
            switch(module_content) {
                case 'preparation':
                    $('#purchase_orders_table').DataTable().draw();
                    modalHideFunction();
                    break;
            }
            break;
        case 'update':
            switch(module_content) {
                case 'leaves':
                    $('#leaves_table').DataTable().draw();

                    break;
            }
            break;
    }
}

function error() {}

function delete_success() {

    switch(module_content) {
        case 'preparation':
            var form_id = $('.form-record')[0].id;
            $('#'+form_id)[0].reset();
            actions = 'save';
            scion.centralized_button(false, true, true, true);

            $('#purchase_orders_table').DataTable().draw();
            break;
    }
}

function delete_error() {}

function generateData() {
    switch(module_content) {
        case 'preparation':
            form_data = {
                _token: _token,
                supplier_id: $('#supplier_id').val(),
                delivery_date: $('#delivery_date').val(),
                site_id: $('#site_id').val(),
                po_date: $('#po_date').val(),
                contact_no: $('#contact_no').val(),
                reference: $('#reference').val(),
                terms: $('#terms').val(),
                due_date: $('#due_date').val(),
                order_no: $('#order_no').val(),
                tax_type: $('#tax_type').val(),
                subtotal: $('#subtotal').val(),
                total_with_tax: $('#total_with_tax').val(),
                delivery_instruction: $('#delivery_instruction').val(),
            };
            break;
    }

    return form_data;
}

function generateDeleteItems() {
    switch(module_content) {
        case 'preparation':
            delete_data = delete_data;
            console.log(delete_data);

            break;
    }
}

// EXTRA FUNCTION
function preparation_func() {
    modal_content = 'preparation';
    module_content = 'preparation';
    module_url = '/purchasing/purchase_orders';
    module_type = 'custom';

    scion.centralized_button(false, true, true, true);

    if ($.fn.DataTable.isDataTable('#purchase_orders_table')) {
        $('#purchase_orders_table').DataTable().destroy();
    }

    scion.create.table(
        'purchase_orders_table',
        module_url + '/get',
        [
            { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'/purchasing/purchase_orders/edit/', "+ row.id +')"><i class="fas fa-pen"></i></a>';
                return html;
            }},
            { data: "DT_RowIndex", title:"#" },
            { data: "id", title:"Status", render: function(data, type, row, meta) {
                if (row.status === 'DRAFT') {
                    html = '<span class="badge badge-info">' + row.status + '</span>'
                } else if (row.status === 'REVIEWED') {
                    html = '<span class="badge badge-warning">' + row.status + '</span>'
                } else if (row.status === 'APPROVED') {
                    html = '<span class="badge badge-primary">' + row.status + '</span>'
                } else {
                    html = '<span class="badge badge-success">' + row.status + '</span>'
                }
                return html;
            }},
            { data: "supplier.supplier_name", title: "Supplier" },
            { data: "delivery_date", title: "Delivery Date" },
            { data: "site.project_name", title: "Ship To" },
            { data: "site.location", title: "Address" },
            { data: "po_date", title: "PO Date" },
            { data: "contact_no", title: "Contact No" },
            { data: "reference", title: "Reference No" },
            { data: "terms", title: "Terms" },
            { data: "due_date", title: "Due Date" },
            { data: "order_no", title: "Order No." },
            { data: "tax_type", title: "Tax Type" },
            { data: "subtotal", title: "Sub Total" },
            { data: "total_with_tax", title: "Total with Tax" },
            { data: "delivery_instruction", title: "Delivery Instruction" },
            // }},
        ], 'Bfrtip', []
    );
}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
}
