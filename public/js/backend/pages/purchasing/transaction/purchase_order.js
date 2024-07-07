$(function() {
    module_content = 'purchase_orders';
    module_url = '/purchasing/purchase_order';
    tab_active = 'preparation';
    page_title = "";
    actions = 'save';
    module_type = 'transaction';
    modal_content = '';
    po_id = '';

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

                case 'preparation_detail':
                    $('#purchase_order_details_table').DataTable().draw();
                    $('#purchase_orders_table').DataTable().draw();
                    scion.create.sc_modal('details_form').hide('', modalHideFunction_detail)

                    break;
            }
            break;
        case 'update':
            switch(module_content) {
                case 'leaves':
                    $('#leaves_table').DataTable().draw();
                    $('#purchase_orders_table').DataTable().draw();
                    modalHideFunction();

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
    active_id = po_id;
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

        case 'preparation_detail':
            form_data = {
                _token: _token,
                purchase_order_id: po_id,
                item: $('#item').val(),
                description: $('#description').val(),
                quantity: $('#quantity').val(),
                unit_price: $('#unit_price').val(),
                discount: $('#discount').val(),
                tax_rate: $('#tax_rate').val(),
                total_amount: $('#total_amount').val(),
                split: $('#split').val(),
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
                html += '<div class="d-flex align-items-center">';
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit(\'/purchasing/purchase_orders/edit/\', ' + row.id + ')"><i class="fas fa-pen"></i></a>';
                html += '<a href="#" class="edit" onclick="add_cart(' + row.id + ')"><i class="fas fa-shopping-cart"></i></a>';
                html += '<a href="#" class="edit" onclick="print(' + row.id + ')"><i class="fas fa-print"></i></a>';
                html += '</div>';

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
            { data: "subtotal", title: "Sub Total" },
            { data: "total_with_tax", title: "Total with Tax" },
            { data: "contact_no", title: "Contact No" },
            { data: "reference", title: "Reference No" },
            { data: "terms", title: "Terms" },
            { data: "due_date", title: "Due Date" },
            { data: "order_no", title: "Order No." },
            { data: "tax_type", title: "Tax Type" },
            { data: "delivery_instruction", title: "Delivery Instruction" },
            // }},
        ], 'Bfrtip', []
    );
}

function add_cart(id) {
    module_content = 'preparation_detail';
    modal_content = 'details';
    module_type = 'custom';
    module_url = '/purchasing/purchase_order_details';
    page_title = 'ADD TO CART';
    po_id = id;

    if ($.fn.DataTable.isDataTable('#purchase_order_detail_table')) {
        $('#purchase_order_detail_table').DataTable().destroy();
    }

    scion.create.table(
        'purchase_order_detail_table',
        '/purchasing/purchase_order_details/get/' + id,
        [
            { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
                var html = "";
                html += '<div class="d-flex align-items-center">';
                html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
                html += '<a href="#" class="align-middle edit" onclick="scion.record.edit(\'/purchasing/purchase_orders/edit/\', ' + row.id + ')"><i class="fas fa-pen"></i></a>';
                html += '</div>';

                return html;
            }},
            { data: "DT_RowIndex", title:"#" },
            { data: "item", title: "Item" },
            { data: "description", title: "Description" },
            { data: "quantity", title: "Quantity" },
            { data: "unit_price", title: "Unit Price" },
            { data: "discount", title: "Discount" },
            { data: "tax_rate", title: "Tax Rate" },
            { data: "total_amount", title: "Total Amount" },

            // }},
        ], 'Bfrtip', []
    );

    scion.create.sc_modal("preparation_detail_form", 'PURCHASE ORDER DETAILS').show(modalShowFunction);

    scion.centralized_button(false, true, true, true);
}

function print(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/purchasing/purchase_orders/print/' + id,
        method: 'post',
        data: {},
        success: function(data) {

            scion.create.sc_modal("poPrint", 'Purchase Order').show(modalShowFunction);

            $('#po_date1').text(moment(data.purchase_orders.po_date).format('MMM DD, YYYY'));
            $('#po_no').text(data.purchase_orders.order_no);
            $('#po_vendor1').text(data.purchase_orders.supplier.supplier_name);
            $('#po_vendor_address1').text(data.purchase_orders.supplier.address);
            $('#po_ship_to1').text(data.purchase_orders.site.project_name);
            $('#po_ship_to_address1').text(data.purchase_orders.site.location);
            $('#po_terms1').text(data.purchase_orders.terms);
            $('#po_due_date1').text(data.purchase_orders.due_date);
            $('#po_prepared_by').text(data.purchase_orders.prepared_by.firstname + ' ' +data.purchase_orders.prepared_by.lastname);
            $('#po_prepared_by_date').text(data.purchase_orders.prepared_at);
            $('#po_total').text('PHP ' + data.purchase_orders.total_with_tax);

            // Clear existing rows (if any) in the details table
            $('#details-table tbody').empty();

            // Populate details into a table
            $.each(data.purchase_orders.details, function(index, detail) {
                var row = $('<tr>');
            row.append('<td>' + detail.item + ' - ' + detail.description + '</td>');
            row.append('<td>' + detail.unit_price + '</td>');
            row.append('<td>' + detail.quantity + '</td>');
            row.append('<td>' + detail.tax_rate + '</td>');
            row.append('<td>' + detail.total_amount + '</td>');
            $('#details-table tbody').append(row);
        });

        }
    });
}

function printDiv() {
    var divToPrint=document.getElementById('printPO');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><head><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"><link rel="stylesheet" href="/css/custom/po-print.css"><link href="/backend/css/modern.css" rel="stylesheet"><link href="/css/custom/id.css" rel="stylesheet"></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();

    // setTimeout(function(){newWin.close();},10);

    setTimeout(function() {
        newWin.print();
    }, 3000); // Change the delay time as needed (in milliseconds)

}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
    scion.create.sc_modal('preparation_form').hide('all')
}

function modalHideFunction_detail() {
    scion.centralized_button(false, true, true, true);
}
