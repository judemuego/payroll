var emp_id = null;
var date_selected = null;
var copied_schedule = [];
var date = new Date();
var period_id = null;

var sequence_no = null;
var schedule_type = null;
var selected_module = null;

var selected_details = '';

$(function() {
    modal_content = 'payroll_summary';
    module_url = '/payroll/summary';
    module_type = 'custom';
    page_title = "List";

    scion.centralized_button(true, true, true, true);
    scion.create.additional_button([
        {
            title: "PREV",
            id: "prev",
            disable: true
        },
        {
            title: "NEXT",
            id: "next",
            disable: true
        }
    ]);

    $.post(module_url + '/get_summary', { _token: _token }).done(function() {
        scion.create.table(
            'payroll_summary_table',  
            module_url + '/get', 
            [
                { data: "schedule_type", title:"SCHEDULE TYPE", render: function(data, type, row, meta) {
                    switch(row.schedule_type) {
                        case 1:
                            return "MONTHLY";
                            break;
                        case 2:
                            return "BI-MONTHLY";
                            break;
                        case 3:
                            return "BI-WEEKLY";
                            break;
                        case 4:
                            return "WEEKLY";
                            break;
                    }
                }},
                { data: "payroll_period", title:"PAYROLL PERIOD", render: function(data, type, row, meta) {
                    return moment(row.payroll_period).format('MMM DD YYYY')
                } },
                { data: "no_of_employee", title:"NO OF EMPLOYEE"},
                { data: "amount", title:"PAYROLL AMOUNT", render: function(data, type, row, meta) {
                    return scion.currency(row.amount);
                }},
                { data: "status", title:"STATUS", render: function(data, type, row, meta) {
                    switch(row.status) {
                        case 0:
                            return "<span class='text-primary' style='font-weight:bold;'>DRAFT</span>";
                            break;

                        case 2:
                            return "<span class='text-warning' style='font-weight:bold;'>PAYSLIP SENT</span>";
                            break;
                    }
                    return "DRAFT";
                }},
                { title:"ACTION", render: function(data, type, row, meta) {
                    return "<button class='btn btn-sm btn-primary view-details' data-id='"+row.id+"' data-sequence='"+row.sequence_no+"' data-sched-type='"+row.schedule_type+"'>VIEW DETAILS</button>" + "<button class='btn btn-sm btn-success set-completed' data-id='"+row.id+"' data-sequence='"+row.sequence_no+"'>COMPLETE</button>";
                }}
            ], 'ftip', []
        );
        
        scion.create.table(
            'payroll_history_table',  
            module_url + '/get_history', 
            [
                { data: "schedule_type", title:"SCHEDULE_TYPE", render: function(data, type, row, meta) {
                    switch(row.schedule_type) {
                        case 1:
                            return "MONTHLY";
                            break;
                        case 2:
                            return "BI-MONTHLY";
                            break;
                        case 3:
                            return "BI-WEEKLY";
                            break;
                        case 4:
                            return "WEEKLY";
                            break;
                    }
                }},
                { data: "payroll_period", title:"PAYROLL PERIOD", render: function(data, type, row, meta) {
                    return moment(row.payroll_period).format('MMM DD YYYY')
                } },
                { data: "no_of_employee", title:"NO OF EMPLOYEE"},
                { data: "amount", title:"PAYROLL AMOUNT", render: function(data, type, row, meta) {
                    return scion.currency(row.amount);
                }},
                { data: "status", title:"STATUS", render: function(data, type, row, meta) {
                    switch(row.status) {
                        case 1:
                            return "<span class='text-success' style='font-weight:bold;'>COMPLETED</span>";
                            break;
                    }
                    return "DRAFT";
                }},
                { title:"ACTION", render: function(data, type, row, meta) {
                    return "<button class='btn btn-sm btn-primary view-details' data-id='"+row.id+"' data-sequence='"+row.sequence_no+"' data-sched-type='"+row.schedule_type+"'>VIEW DETAILS</button>";
                }}
            ], 'ftip', []
        );
    });

    $('#payroll_summary_table').on('click', '.view-details', function() {
        period_id = $(this).attr('data-id');
        sequence_no = $(this).attr('data-sequence');
        schedule_type = $(this).attr('data-sched-type');
        selected_details = 'summary';

        $('.sent-email').css('display', 'block');
        $('#print_payslip button').css('display', 'block');

        scion.record.new();
        
        if ($.fn.DataTable.isDataTable('#payroll_details_table')) {
            $('#payroll_details_table').DataTable().clear().destroy();
        }

        scion.create.table(
            'payroll_details_table',  
            module_url + '/get_details/' + sequence_no, 
            [
                { data: "status", title: "", render: function(data, type, row, meta) {
                    var html = "";

                    html = "<input type='checkbox' class='check-status status-"+row.id+"' data-id='"+row.id+"'/>"
                    $('.status-' + row.id).prop('checked', row.status === 1?true:false);

                    return html;
                }},
                { data: "employee.firstname", title:"NAME", width: "200px", render: function(data, type, row, meta) {
                    return row.employee.firstname + (row.employee.middlename === ""?" "+row.employee.middlename:" ") + row.employee.lastname + (row.employee.suffix === ""?" "+row.employee.suffix:"");
                }},
                { data: "sequence_no", title:"SEQUENCE"},
                { data: "gross_earnings", title:"GROSS EARNING", render: function(data, type, row, meta) {
                    return scion.currency(row.gross_earnings);
                }},
                { data: "sss", title:"SSS", render: function(data, type, row, meta) {
                    return scion.currency(row.sss);
                }},
                { data: "pagibig", title:"PAG IBIG", render: function(data, type, row, meta) {
                    return scion.currency(row.pagibig);
                }},
                { data: "philhealth", title:"PHILHEALTH", render: function(data, type, row, meta) {
                    return scion.currency(row.philhealth);
                }},
                { data: "tax", title:"TAX", render: function(data, type, row, meta) {
                    return scion.currency(row.tax);
                }},
                { data: "net_pay", title:"NET PAY", render: function(data, type, row, meta) {
                    return scion.currency(row.net_pay);
                }},
                { title:"", render: function(data, type, row, meta) {
                    return "<button class='view-payslip' data-sequence='"+row.sequence_no+"' data-emp-id='"+row.employee_id+"'><i class='fas fa-receipt'></i></button>";
                }}
            ], 'ftip', [], true, false
        );

        get_overall(sequence_no, schedule_type);

        scion.centralized_button(true, true, true, true);

    }).on('click', '.set-completed', function() {
        period_id = $(this).attr('data-id');
        sequence_no = $(this).attr('data-sequence');
        $('.sequence_no_disp').text(sequence_no);

        scion.sc_modal_show('approval_confirmation');
        
    });

    $('#payroll_history_table').on('click', '.view-details', function() {
        period_id = $(this).attr('data-id');
        sequence_no = $(this).attr('data-sequence');
        schedule_type = $(this).attr('data-sched-type');
        selected_details = 'history';
        
        $('.sent-email').css('display', 'none');
        $('#print_payslip button').css('display', 'none');

        scion.record.new();
        
        if ($.fn.DataTable.isDataTable('#payroll_details_table')) {
            $('#payroll_details_table').DataTable().clear().destroy();
        }

        scion.create.table(
            'payroll_details_table',  
            module_url + '/get_details/' + sequence_no, 
            [
                { data: "status", title: "", render: function(data, type, row, meta) {
                    var html = "";

                    html = "<input type='checkbox' class='check-status status-"+row.id+"' data-id='"+row.id+"' disabled/>"
                    $('.status-' + row.id).prop('checked', row.status === 1?true:false);

                    return html;
                }},
                { data: "employee.firstname", title:"NAME", width: "200px", render: function(data, type, row, meta) {
                    return row.employee.firstname + (row.employee.middlename === ""?" "+row.employee.middlename:" ") + row.employee.lastname + (row.employee.suffix === ""?" "+row.employee.suffix:"");
                }},
                { data: "sequence_no", title:"SEQUENCE"},
                { data: "gross_earnings", title:"GROSS EARNING", render: function(data, type, row, meta) {
                    return scion.currency(row.gross_earnings);
                }},
                { data: "sss", title:"SSS", render: function(data, type, row, meta) {
                    return scion.currency(row.sss);
                }},
                { data: "pagibig", title:"PAG IBIG", render: function(data, type, row, meta) {
                    return scion.currency(row.pagibig);
                }},
                { data: "philhealth", title:"PHILHEALTH", render: function(data, type, row, meta) {
                    return scion.currency(row.philhealth);
                }},
                { data: "tax", title:"TAX", render: function(data, type, row, meta) {
                    return scion.currency(row.tax);
                }},
                { data: "net_pay", title:"NET PAY", render: function(data, type, row, meta) {
                    return scion.currency(row.net_pay);
                }},
                { title:"", render: function(data, type, row, meta) {
                    return "<button class='view-payslip' data-sequence='"+row.sequence_no+"' data-emp-id='"+row.employee_id+"'><i class='fas fa-receipt'></i></button>";
                }}
            ], 'ftip', [], true, false
        );

        get_overall(sequence_no, schedule_type);

        scion.centralized_button(true, true, true, true);
    });

    $('#payroll_summary_form').on('click', '.view-payslip', function() {
        var sequence_no = $(this).attr('data-sequence');
        emp_id = $(this).attr('data-emp-id');

        selected_print = 'print_payslip';

        $('#payslip_form').css('display', 'block');
        $('#payslip_form').css('position', 'fixed');

        $('#additional_buttons button').prop('disabled', false);
        scion.centralized_button(true, true, true, false);

        updatePayslip();
    }).on('click', '.sent-email', function() {
        $.post(module_url + '/update_status', { _token: _token, id: period_id, status: 2 }).done(function(response) {
            $('#payroll_summary_table').DataTable().draw();
            $('#payroll_history_table').DataTable().draw();

            scion.create.sc_modal('payroll_summary_form').hide('all', modalHideFunction);
        });
    });

    $('#payslip_form').on('click', '#add_earnings', function() {
        selected_module = "earning";
        
        $('#add_details').css('display', 'block');
        $('#add_details').css('position', 'fixed');

        $('#add_details .sc-title-bar').text('ADD EARNING');

        $.get(module_url + '/get_earnings').done(function(response) {
            var option = "";

            option += "<option value=''>PLEASE SELECT EARNING TYPE</option>";

            $.each(response.earnings, function(i, val){
                option += "<option value='"+val.id+"'>"+val.name+"</option>";
            });

            $('#add_details #type').html(option);
        });

        scion.centralized_button(true, false, true, true);
    }).on('click', '#add_deductions', function() {
        selected_module = "deduction";
        $('#add_details').css('display', 'block');
        $('#add_details').css('position', 'fixed');

        $('#add_details .sc-title-bar').text('ADD DEDUCTION');
        
        $.get(module_url + '/get_deductions').done(function(response) {
            var option = "";

            option += "<option value=''>PLEASE SELECT DEDUCTION TYPE</option>";

            $.each(response.deductions, function(i, val){
                option += "<option value='"+val.id+"'>"+val.name+"</option>";
            });

            $('#add_details #type').html(option);
        });
        
        scion.centralized_button(true, false, true, true);
    });

    $('#approval_confirmation').on('click', '.positive-button', function() {
        $.post(module_url + '/update_status', { _token: _token, id: period_id, status: 1 }).done(function(response) {
            $('#payroll_summary_table').DataTable().draw();
            $('#payroll_history_table').DataTable().draw();
            scion.create.sc_modal('approval_confirmation').hide('all', modalHideFunction);
        });
    }).on('click', '.negative-button', function() {
        scion.create.sc_modal('approval_confirmation').hide('all', modalHideFunction)
    });

    $('#payroll_details_table').on('click', '.check-status', function() {
        var id = $(this).attr('data-id');
        var status = $(this).prop('checked') === true?1:0;

        $.post(module_url + '/update_details_status', { _token: _token, id: id, status: status }).done(function(response) {
            $('#payroll_summary_table').DataTable().draw();
            get_overall(sequence_no, schedule_type);
        });
    });

    $('.action-buttons').on('click', '#next', function() {
        $.post(module_url + '/show', { _token:_token,  employee_id: emp_id, sequence_no: sequence_no }).done(function(response) {
            if(response.next !== null) {
                emp_id = response.next.employee_id;
                updatePayslip();
            }
            else {
                if(response.previous !== null) {
                    emp_id = response.previous.employee_id;
                    updatePayslip();
                }
            }
        });
    }).on('click', '#prev', function() {
        $.post(module_url + '/show', { _token:_token,  employee_id: emp_id, sequence_no: sequence_no }).done(function(response) {
            if(response.previous !== null) {
                emp_id = response.previous.employee_id;
                updatePayslip();
            }
            else {
                if(response.next !== null) {
                    emp_id = response.next.employee_id;
                    updatePayslip();
                }
            }
        });
    });

});


function success() {
    switch(actions) {
        case 'save':
            break;
        case 'update':
            break;
    }

    $('#amount').val('0');

    $('#payroll_details_table').DataTable().draw();
    updatePayslip();

    scion.create.sc_modal('add_details').hide('', modalHideFunction);
}

function error() {}

function delete_success() {
    $('#payroll_summary_table').DataTable().draw();
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token,
        "employee_id": emp_id,
        "sequence_no": sequence_no,
        "type": $('#type').val(),
        "amount": $('#amount').val(),
        "module": selected_module
    };

    return form_data;
}

function generateDeleteItems(){}


function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(true, true, true, true);
}

function customFunc() {
    scion.centralized_button(true, true, true, true);
}

function updatePayslip() {
    
    $.post(module_url + '/get_earnings_and_deductions', { _token: _token, sequence_no: sequence_no, employee_id: emp_id, schedule_type: schedule_type }).done(function(response){
        var data = response;
        var earning_tbl = "";
        var deduction_tbl = "";

        // Set Employee Information
        $('#t-full_name').text((data.employee.firstname + (data.employee.middlename !== "" && data.employee.middlename !== null?" " + data.employee.middlename + " ":" ") + data.employee.lastname + (data.employee.suffix !== "" && data.employee.suffix !== null?" " + data.employee.suffix:"")));
        $('#t-address').text(data.employee.street_1 + " " + data.employee.barangay_1 + " " + data.employee.city_1 + ", " + data.employee.province_1 + " " + data.employee.country_1+ ", " + data.employee.zip_1);
        $('#t-contact').text(data.employee.phone1);
        $('#t-email').text(data.employee.email);

        // Set Earnings
        $.each(data.earnings, function(i, val) {

            earning_tbl += "<tr>";
                earning_tbl += "<td><b>"+val.earning.name+"</b></td>";
                earning_tbl += "<td>"+(val.rate!==""?val.rate:"-")+"</td>";
                earning_tbl += "<td>"+(val.hours!==""?val.hours:"-")+"</td>";
                earning_tbl += "<td class='text-right'>"+(val.total!==""?scion.currency(val.total):"-")+"</td>";
            earning_tbl += "</tr>";

        });
        $('div#earnings tbody').html(earning_tbl);
        
        // Set Deductions
        $.each(data.deductions, function(i, val) {

            switch(val.deduction.id) {
                case 1:
                    $('#mandated #sss').text(scion.currency(val.total));
                    break;
                case 2:
                    $('#mandated #philhealth').text(scion.currency(val.total));
                    break;
                case 3:
                    $('#mandated #pagibig').text(scion.currency(val.total));
                    break;
                default:
                    deduction_tbl += "<tr>";
                        deduction_tbl += "<td><b>"+val.deduction.name+"</b> <i></td>";
                        deduction_tbl += "<td class='text-right'>"+(val.total!==""?scion.currency(val.total):"-")+"</td>";
                    deduction_tbl += "</tr>";
            }

        });
        
        $('#other tbody').html(deduction_tbl);
        
        $('#earnings .total').text(scion.currency(response.earnings_total));
        $('#deductions .total').text(scion.currency(response.deductions_total));
        $('#taxable-amount').text(scion.currency(response.taxable_amount));
        $('#withholding-tax').text(scion.currency(response.withholding_tax));
        $('#net-pay').text(scion.currency(response.netpay));

        $('#paydate').text(moment(response.summary.pay_date).format('MMM DD YYYY'));
        $('#paytype').text(response.summary.calendar.title);
        $('#period').text(moment(response.summary.payroll_period).format('MMM DD YYYY'));
        $('#sequence').text(sequence_no);
        $('#paymentmethod').text("CASH");
        $('#netpay').text(scion.currency(response.netpay));
    });
}

function get_overall(sequence, type) {
    scion.record.get('get_overall', { _token: _token, sequence_no: sequence, type: type  },
        function(response) {
            $('#total_gross').text(scion.currency(response.total.gross));
            $('#total_sss').text(scion.currency(response.total.sss));
            $('#total_philhealth').text(scion.currency(response.total.philhealth));
            $('#total_pagibig').text(scion.currency(response.total.pagibig));
            $('#total_tax').text(scion.currency(response.total.tax));
            $('#total_netpay').text(scion.currency(response.total.net_pay));
        }
    );
}

function custom_modalHide() {
    selected_print = null;
    $('#additional_buttons button').prop('disabled', true);
    modalHideFunction();
}