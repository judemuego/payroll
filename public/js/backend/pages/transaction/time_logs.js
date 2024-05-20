var emp_id = null;
var earnings = [];
var schedule_selected = null;

$(function() {
    modal_content = 'time_logs';
    module_url = '/payroll/time_logs';
    module_type = 'custom';
    page_title = "Time Plotting";

    const today = new Date();

    $('#date-filter').val(moment(today).format('YYYY-MM-DD'));
    scion.centralized_button(true, true, true, true);
    
    scion.create.table(
        'employee_table',  
        module_url + '/get/all/' + scion.getDateRange($('#date-filter').val(), 1).first + '/' + scion.getDateRange($('#date-filter').val(), 1).last, 
        [
            { data: "firstname", title:"EMPLOYEE", render: function(data, type, row, meta) {
                return "<div class='employee_info' onclick='addRecord("+row.id+")'><img src='/images/payroll/employee-information/"+row.profile_img+"'/>" + row.firstname + " " + (row.middlename !== null && row.middlename !== ""?row.middlename + " ":"") + row.lastname + (row.suffix !== null && row.suffix !== ""?" " + row.suffix:"") + "</div>";
            }},
            { data: "sun", title:"SUNDAY <br> " + scion.getDateRange($('#date-filter').val(), 1).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.sun!==null?row.sun.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.sun!==null?row.sun.split('|')[4]:'')+"' list='"+(row.sun!==null?row.sun.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.sun!==null?row.sun.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.sun!==null?row.sun.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.sun!==null?row.sun.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.sun!==null?row.sun.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.sun!==null?row.sun.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "mon", title:"MONDAY <br> " + scion.getDateRange($('#date-filter').val(), 2).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.mon!==null?row.mon.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.mon!==null?row.mon.split('|')[4]:'')+"' list='"+(row.mon!==null?row.mon.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.mon!==null?row.mon.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.mon!==null?row.mon.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.mon!==null?row.mon.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.mon!==null?row.mon.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.mon!==null?row.mon.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "tue", title:"TUESDAY <br> " + scion.getDateRange($('#date-filter').val(), 3).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.tue!==null?row.tue.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.tue!==null?row.tue.split('|')[4]:'')+"' list='"+(row.tue!==null?row.tue.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.tue!==null?row.tue.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.tue!==null?row.tue.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.tue!==null?row.tue.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.tue!==null?row.tue.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.tue!==null?row.tue.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "wed", title:"WEDNESDAY <br> " + scion.getDateRange($('#date-filter').val(), 4).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.wed!==null?row.wed.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.wed!==null?row.wed.split('|')[4]:'')+"' list='"+(row.wed!==null?row.wed.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.wed!==null?row.wed.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.wed!==null?row.wed.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.wed!==null?row.wed.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.wed!==null?row.wed.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.wed!==null?row.wed.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "thu", title:"THURSDAY <br> " + scion.getDateRange($('#date-filter').val(), 5).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.thu!==null?row.thu.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.thu!==null?row.thu.split('|')[4]:'')+"' list='"+(row.thu!==null?row.thu.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.thu!==null?row.thu.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.thu!==null?row.thu.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.thu!==null?row.thu.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.thu!==null?row.thu.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.thu!==null?row.thu.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "fri", title:"FRIDAY <br> " + scion.getDateRange($('#date-filter').val(), 6).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.fri!==null?row.fri.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.fri!==null?row.fri.split('|')[4]:'')+"' list='"+(row.fri!==null?row.fri.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.fri!==null?row.fri.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.fri!==null?row.fri.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.fri!==null?row.fri.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.fri!==null?row.fri.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.fri!==null?row.fri.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "sat", title:"SATURDAY <br> " + scion.getDateRange($('#date-filter').val(), 7).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.sat!==null?row.sat.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.sat!==null?row.sat.split('|')[4]:'')+"' list='"+(row.sat!==null?row.sat.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.sat!==null?row.sat.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }

                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.sat!==null?row.sat.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.sat!==null?row.sat.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.sat!==null?row.sat.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.sat!==null?row.sat.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "status", title: "STATUS"},
            { data: "reg", title: "REG"},
            { data: "ot", title: "OT"},
            { data: "sick", title: "SICK"},
            { data: "vac", title: "VAC"},
            { data: "total", title: "TOTAL"}
        ], 'Bfrtip', ['csv', 'pdf'], true, false
    );

    scion.record.get('earnings', {}, function(response) {
        earnings = response.earnings;
    });

    $('#employee_table').on('click', '.record-status', function(){
        if($('#list_' + $(this).attr('list')).hasClass('show') !== true) {
            schedule_selected = $(this).attr('list');
            $('.status-list').removeClass('show');
            $('#list_' + $(this).attr('list')).addClass('show');
        }
        else {
            schedule_selected = null;
            $('#list_' + $(this).attr('list')).removeClass('show');
        }
    }).on('click', '.status-list a', function() {
        var status = $(this).attr('status');
        $.post(module_url+'/update-status', { "_token": _token, "id": schedule_selected, "status": status }).done((response)=>{
            $('#employee_table').DataTable().draw();
            toastr.success('Status updated!');
        });
    });

    $('#time_plotting').on('change', '.time-in', function(){
        var day = $($(this).parent()).attr('day');
        var time_in = this.value;
        var time_out = $('#entry_' + day + ' .time-out').val();

        if(time_out !== "") {
            var total_hours = (new Date(time_out) - new Date(time_in) ) / 1000 / 60 / 60;
            $('#entry_' + day + ' .total-hours').val(parseFloat(total_hours).toFixed(2));
        }
        else {
            $('#entry_' + day + ' .total-hours').val(parseFloat("0").toFixed(2));
        }
    }).on('change', '.time-out', function(){
        var day = $($(this).parent()).attr('day');
        var time_in = $('#entry_' + day + ' .time-in').val();
        var time_out = this.value;

        if(time_in !== "") {
            var total_hours = (new Date(time_out) - new Date(time_in) ) / 1000 / 60 / 60;
            $('#entry_' + day + ' .total-hours').val(parseFloat(total_hours).toFixed(2));
        }
        else {
            $('#entry_' + day + ' .total-hours').val(parseFloat("0").toFixed(2));
        }
    });

    $('#time_logs_form').on('click', '.crs', function() {
        $.each($('.time-entry'), (i,v)=>{
            var tag_id = v.id;
            var no_day = parseInt(i + 1);
            
            if(($('#'+tag_id+' .time-in').val() !== "" && $('#'+tag_id+' .time-out').val() !== "" && $('#'+tag_id+' .type').val() !== "") || ($('#'+tag_id+' .type').val() !== "")) {
                var data = {
                    date: scion.getDateRange($('#date-filter').val(), no_day).current,
                    time_in: $('#'+tag_id+' .time-in').val(),
                    time_out: $('#'+tag_id+' .time-out').val(),
                    employee_id: emp_id,
                    type: $('#'+tag_id+' .type').val(),
                    total_hours: $('#'+tag_id+' .total-hours').val(),
                    ot_hours: $('#'+tag_id+' .ot-hours').val(),
                    late_hours: $('#'+tag_id+' .late-hours').val(),
                    undertime: $('#'+tag_id+' .undertime').val()
                };
        
                scion.record.get('cross-matching', data, function(response){
                });

            }
        });
        addRecord(emp_id);
        success();
    });

});


function success() {
    switch(actions) {
        case 'save':
            break;
        case 'update':
            break;
    }
    $('#employee_table').DataTable().draw();
    // scion.create.sc_modal('scheduling_form').hide('all', modalHideFunction);
}

function error() {}

function delete_success() {
    $('#employee_table').DataTable().draw();
}

function delete_error() {}

function generateData() {
    form_data = {
        _token: _token,
        record :[]
    };

    $.each($('.time-entry'), (i,v)=>{
        var tag_id = v.id;

        form_data.record.push({
            employee_id: emp_id,
            date: scion.getDateRange($('#date-filter').val(), parseInt(i+1)).current,
            time_in: $('#'+tag_id+' .time-in').val(),
            time_out: $('#'+tag_id+' .time-out').val(),
            break_in: '',
            break_out: '',
            ot_in: '',
            ot_out: '',
            type: $('#'+tag_id+' .type').val(),
            total_hours: $('#'+tag_id+' .total-hours').val(),
            break_hours: 0,
            ot_hours: $('#'+tag_id+' .ot-hours').val(),
            late_hours: $('#'+tag_id+' .late-hours').val(),
            undertime: $('#'+tag_id+' .undertime').val(),
            status: 0,
            schedule_status: 0
        });
    });

    return form_data;
}

function generateDeleteItems(){}


function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(true, true, true, true);
}

// CUSTOM FUNCTION
function addRecord(id) {
    
    emp_id = id;
    scion.record.new(function() {
        if ($.fn.DataTable.isDataTable('#time_plotting')) {
            $('#time_plotting').DataTable().clear().destroy();
        }
        scion.create.table(
            'time_plotting',  
            module_url + '/plot/' + id + '/' + scion.getDateRange($('#date-filter').val(), 1).first + '/' + scion.getDateRange($('#date-filter').val(), 1).last, 
            [
                { data: "sun", title:"SUNDAY <br> " + scion.getDateRange($('#date-filter').val(), 1).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 1).current;
                    
                    if((row.sun!==null?row.sun.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.sun!==null?row.sun.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_sun'>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sun'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.sun!==null?row.sun.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";
                    
                    $('#entry_sun .time-in').attr('min', date_current + " 00:00");
                    $('#entry_sun .time-in').attr('max', date_current + " 23:59");
                    $('#entry_sun .time-out').attr('min', date_current + " 00:00");

                    $('#entry_sun .time-in').val((row.sun!==null?row.sun.split('|')[0]:date_current + " 00:00"));
                    $('#entry_sun .time-out').val((row.sun!==null?row.sun.split('|')[1]:date_current + " 00:00"));
                    $('#entry_sun .total-hours').val((row.sun!==null?row.sun.split('|')[2]:'0.00'));
                    $('#entry_sun .type').val((row.sun!==null?row.sun.split('|')[3]:''));
                    $('#entry_sun .ot-hours').val((row.sun!==null?row.sun.split('|')[4]:'0.00'));
                    $('#entry_sun .late-hours').val((row.sun!==null?row.sun.split('|')[5]:'0.00'));
                    $('#entry_sun .undertime').val((row.sun!==null?row.sun.split('|')[6]:'0.00'));
                    $('#entry_sun .schedule-status').val((row.sun!==null?row.sun.split('|')[6]:'0.00'));



                    return tag;
                }},
                { data: "mon", title:"MONDAY <br> " + scion.getDateRange($('#date-filter').val(), 2).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 2).current;
                    
                    if((row.mon!==null?row.mon.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.mon!==null?row.mon.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_mon'>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='mon'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.mon!==null?row.mon.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";

                    $('#entry_mon .time-in').attr('min', date_current + " 00:00");
                    $('#entry_mon .time-in').attr('max', date_current + " 23:59");
                    $('#entry_mon .time-out').attr('min', date_current + " 00:00");

                    $('#entry_mon .time-in').val((row.mon!==null?row.mon.split('|')[0]:date_current + " 00:00"));
                    $('#entry_mon .time-out').val((row.mon!==null?row.mon.split('|')[1]:date_current + " 00:00"));
                    $('#entry_mon .total-hours').val((row.mon!==null?row.mon.split('|')[2]:'0.00'));
                    $('#entry_mon .type').val((row.mon!==null?row.mon.split('|')[3]:''));
                    $('#entry_mon .ot-hours').val((row.mon!==null?row.mon.split('|')[4]:'0.00'));
                    $('#entry_mon .late-hours').val((row.mon!==null?row.mon.split('|')[5]:'0.00'));
                    $('#entry_mon .undertime').val((row.mon!==null?row.mon.split('|')[6]:'0.00'));



                    return tag;
                }},
                { data: "tue", title:"TUESDAY <br> " + scion.getDateRange($('#date-filter').val(), 3).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 3).current;
                    
                    if((row.tue!==null?row.tue.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.tue!==null?row.tue.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_tue'>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='tue'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.tue!==null?row.tue.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";

                    $('#entry_tue .time-in').attr('min', date_current + " 00:00");
                    $('#entry_tue .time-in').attr('max', date_current + " 23:59");
                    $('#entry_tue .time-out').attr('min', date_current + " 00:00");

                    $('#entry_tue .time-in').val((row.tue!==null?row.tue.split('|')[0]:date_current + " 00:00"));
                    $('#entry_tue .time-out').val((row.tue!==null?row.tue.split('|')[1]:date_current + " 00:00"));
                    $('#entry_tue .total-hours').val((row.tue!==null?row.tue.split('|')[2]:'0.00'));
                    $('#entry_tue .type').val((row.tue!==null?row.tue.split('|')[3]:''));
                    $('#entry_tue .ot-hours').val((row.tue!==null?row.tue.split('|')[4]:'0.00'));
                    $('#entry_tue .late-hours').val((row.tue!==null?row.tue.split('|')[5]:'0.00'));
                    $('#entry_tue .undertime').val((row.tue!==null?row.tue.split('|')[6]:'0.00'));

                    return tag;
                }},
                { data: "wed", title:"WEDNESDAY <br> " + scion.getDateRange($('#date-filter').val(), 4).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 4).current;
                    
                    if((row.wed!==null?row.wed.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.wed!==null?row.wed.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_wed'>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='wed'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.wed!==null?row.wed.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";

                    $('#entry_wed .time-in').attr('min', date_current + " 00:00");
                    $('#entry_wed .time-in').attr('max', date_current + " 23:59");
                    $('#entry_wed .time-out').attr('min', date_current + " 00:00");

                    $('#entry_wed .time-in').val((row.wed!==null?row.wed.split('|')[0]:date_current + " 00:00"));
                    $('#entry_wed .time-out').val((row.wed!==null?row.wed.split('|')[1]:date_current + " 00:00"));
                    $('#entry_wed .total-hours').val((row.wed!==null?row.wed.split('|')[2]:'0.00'));
                    $('#entry_wed .type').val((row.wed!==null?row.wed.split('|')[3]:''));
                    $('#entry_wed .ot-hours').val((row.wed!==null?row.wed.split('|')[4]:'0.00'));
                    $('#entry_wed .late-hours').val((row.wed!==null?row.wed.split('|')[5]:'0.00'));
                    $('#entry_wed .undertime').val((row.wed!==null?row.wed.split('|')[6]:'0.00'));

                    return tag;
                }},
                { data: "thu", title:"THURSDAY <br> " + scion.getDateRange($('#date-filter').val(), 5).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 5).current;
                    
                    if((row.thu!==null?row.thu.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.thu!==null?row.thu.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_thu'>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='thu'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.thu!==null?row.thu.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";

                    $('#entry_thu .time-in').attr('min', date_current + " 00:00");
                    $('#entry_thu .time-in').attr('max', date_current + " 23:59");
                    $('#entry_thu .time-out').attr('min', date_current + " 00:00");

                    $('#entry_thu .time-in').val((row.thu!==null?row.thu.split('|')[0]:date_current + " 00:00"));
                    $('#entry_thu .time-out').val((row.thu!==null?row.thu.split('|')[1]:date_current + " 00:00"));
                    $('#entry_thu .total-hours').val((row.thu!==null?row.thu.split('|')[2]:'0.00'));
                    $('#entry_thu .type').val((row.thu!==null?row.thu.split('|')[3]:''));
                    $('#entry_thu .ot-hours').val((row.thu!==null?row.thu.split('|')[4]:'0.00'));
                    $('#entry_thu .late-hours').val((row.thu!==null?row.thu.split('|')[5]:'0.00'));
                    $('#entry_thu .undertime').val((row.thu!==null?row.thu.split('|')[6]:'0.00'));
                    
                    return tag;
                }},
                { data: "fri", title:"FRIDAY <br> " + scion.getDateRange($('#date-filter').val(), 6).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 6).current;
                    
                    if((row.fri!==null?row.fri.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.fri!==null?row.fri.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_fri'>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='fri'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.fri!==null?row.fri.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";

                    $('#entry_fri .time-in').attr('min', date_current + " 00:00");
                    $('#entry_fri .time-in').attr('max', date_current + " 23:59");
                    $('#entry_fri .time-out').attr('min', date_current + " 00:00");

                    $('#entry_fri .time-in').val((row.fri!==null?row.fri.split('|')[0]:date_current + " 00:00"));
                    $('#entry_fri .time-out').val((row.fri!==null?row.fri.split('|')[1]:date_current + " 00:00"));
                    $('#entry_fri .total-hours').val((row.fri!==null?row.fri.split('|')[2]:'0.00'));
                    $('#entry_fri .type').val((row.fri!==null?row.fri.split('|')[3]:''));
                    $('#entry_fri .ot-hours').val((row.fri!==null?row.fri.split('|')[4]:'0.00'));
                    $('#entry_fri .late-hours').val((row.fri!==null?row.fri.split('|')[5]:'0.00'));
                    $('#entry_fri .undertime').val((row.fri!==null?row.fri.split('|')[6]:'0.00'));
                    
                    return tag;
                }},
                { data: "sat", title:"SATURDAY <br> " + scion.getDateRange($('#date-filter').val(), 7).current, render: function(data, type, row, meta) {
                    var tag = "";
                    var sched_status = '-';
                    var date_current = scion.getDateRange($('#date-filter').val(), 7).current;
                    
                    if((row.sat!==null?row.sat.split('|')[7]:'0') === "1") {
                        sched_status = 'WITH SCHEDULE';
                    }
                    else if((row.sat!==null?row.sat.split('|')[7]:'0') === "2"){
                        sched_status = 'NO SCHEDULE';
                    }

                    tag += "<div class='time-entry' id='entry_sat'>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>TIME IN:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-in'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>TIME OUT:</label>";
                            tag += "<input type='datetime-local' class='form-control input-sm time-out'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>TOTAL HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm total-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>TYPE:</label>";
                            tag += "<select class='form-control type' name='type'>";
                                tag += "<option value=''></option>";
                                $.each(earnings, (i, val)=>{
                                    tag += "<option value='"+val.id+"'>"+val.name+"</option>";
                                });
                            tag += "</select>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>OT HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm ot-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>LATE HOURS:</label>";
                            tag += "<input type='text' class='form-control input-sm late-hours' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group' day='sat'>";
                            tag += "<label>UNDERTIME:</label>";
                            tag += "<input type='text' class='form-control input-sm undertime' value='0.00'/>";
                        tag += "</div>";
                        tag += "<div class='form-group'>";
                            tag += "<label>SCHEDULE STATUS:</label>";
                            tag += "<div class='schedule-status sch-"+(row.sat!==null?row.sat.split('|')[7]:'0')+"'>"+sched_status+"</div>";
                        tag += "</div>";
                    tag += "</div>";
                    
                    $('#entry_sat .time-in').attr('min', date_current + " 00:00");
                    $('#entry_sat .time-in').attr('max', date_current + " 23:59");
                    $('#entry_sat .time-out').attr('min', date_current + " 00:00");

                    $('#entry_sat .time-in').val((row.sat!==null?row.sat.split('|')[0]:date_current + " 00:00"));
                    $('#entry_sat .time-out').val((row.sat!==null?row.sat.split('|')[1]:date_current + " 00:00"));
                    $('#entry_sat .total-hours').val((row.sat!==null?row.sat.split('|')[2]:'0.00'));
                    $('#entry_sat .type').val((row.sat!==null?row.sat.split('|')[3]:''));
                    $('#entry_sat .ot-hours').val((row.sat!==null?row.sat.split('|')[4]:'0.00'));
                    $('#entry_sat .late-hours').val((row.sat!==null?row.sat.split('|')[5]:'0.00'));
                    $('#entry_sat .undertime').val((row.sat!==null?row.sat.split('|')[6]:'0.00'));
                    
                    return tag;
                }}
            ], '', [], true, false
        );
    });

}

function filter(department) {
    var first = scion.getDateRange($('#date-filter').val(), 1).first;
    var last = scion.getDateRange($('#date-filter').val(), 1).last;

    $('#employee_table').DataTable().destroy().clear().draw();

    scion.create.table(
        'employee_table',  
        module_url + '/get/' + department + '/' + scion.getDateRange($('#date-filter').val(), 1).first + '/' + scion.getDateRange($('#date-filter').val(), 1).last, 
        [
            { data: "firstname", title:"EMPLOYEE", render: function(data, type, row, meta) {
                return "<div class='employee_info' onclick='addRecord("+row.id+")'><img src='/images/payroll/employee-information/"+row.profile_img+"'/>" + row.firstname + " " + (row.middlename !== null && row.middlename !== ""?row.middlename + " ":"") + row.lastname + (row.suffix !== null && row.suffix !== ""?" " + row.suffix:"") + "</div>";
            }},
            { data: "sun", title:"SUNDAY <br> " + scion.getDateRange($('#date-filter').val(), 1).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.sun!==null?row.sun.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.sun!==null?row.sun.split('|')[4]:'')+"' list='"+(row.sun!==null?row.sun.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.sun!==null?row.sun.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.sun!==null?row.sun.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.sun!==null?row.sun.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.sun!==null?row.sun.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.sun!==null?row.sun.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "mon", title:"MONDAY <br> " + scion.getDateRange($('#date-filter').val(), 2).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.mon!==null?row.mon.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.mon!==null?row.mon.split('|')[4]:'')+"' list='"+(row.mon!==null?row.mon.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.mon!==null?row.mon.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.mon!==null?row.mon.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.mon!==null?row.mon.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.mon!==null?row.mon.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.mon!==null?row.mon.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "tue", title:"TUESDAY <br> " + scion.getDateRange($('#date-filter').val(), 3).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.tue!==null?row.tue.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.tue!==null?row.tue.split('|')[4]:'')+"' list='"+(row.tue!==null?row.tue.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.tue!==null?row.tue.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.tue!==null?row.tue.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.tue!==null?row.tue.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.tue!==null?row.tue.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.tue!==null?row.tue.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "wed", title:"WEDNESDAY <br> " + scion.getDateRange($('#date-filter').val(), 4).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.wed!==null?row.wed.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.wed!==null?row.wed.split('|')[4]:'')+"' list='"+(row.wed!==null?row.wed.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.wed!==null?row.wed.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.wed!==null?row.wed.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.wed!==null?row.wed.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.wed!==null?row.wed.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.wed!==null?row.wed.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "thu", title:"THURSDAY <br> " + scion.getDateRange($('#date-filter').val(), 5).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.thu!==null?row.thu.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.thu!==null?row.thu.split('|')[4]:'')+"' list='"+(row.thu!==null?row.thu.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.thu!==null?row.thu.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.thu!==null?row.thu.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.thu!==null?row.thu.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.thu!==null?row.thu.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.thu!==null?row.thu.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "fri", title:"FRIDAY <br> " + scion.getDateRange($('#date-filter').val(), 6).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.fri!==null?row.fri.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.fri!==null?row.fri.split('|')[4]:'')+"' list='"+(row.fri!==null?row.fri.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.fri!==null?row.fri.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.fri!==null?row.fri.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.fri!==null?row.fri.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.fri!==null?row.fri.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.fri!==null?row.fri.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "sat", title:"SATURDAY <br> " + scion.getDateRange($('#date-filter').val(), 7).current, width:'150px', render: function(data, type, row, meta) {
                var tag = "";
                if((row.sat!==null?row.sat.split('|')[4]:'') !== '') {
                    tag += "<div class='record-status status-"+(row.sat!==null?row.sat.split('|')[4]:'')+"' list='"+(row.sat!==null?row.sat.split('|')[5]:'')+"'></div>";
                    tag += "<div class='status-list' id='list_"+(row.sat!==null?row.sat.split('|')[5]:'')+"'>";
                    tag += "<ul>";
                    tag += "<li><a href='#' status='0'>DRAFT</a></li>";
                    tag += "<li><a href='#' status='1'>SUBMITTED</a></li>";
                    tag += "<li><a href='#' status='2'>FOR APPROVAL</a></li>";
                    tag += "<li><a href='#' status='3'>APPROVED</a></li>";
                    tag += "<li><a href='#' status='4'>ON HOLD</a></li>";
                    tag += "<li><a href='#' status='5'>FOR ADJUSTMENT</a></li>";
                    tag += "</ul>";
                    tag += "</div>";
                }
                tag += "<div class='record-details'>"+
                        "<div class='time-in'><b>IN: </b> <span>"+(row.sat!==null?row.sat.split('|')[0]:'')+"</span></div>"+
                        "<div class='time-out'><b>OUT: </b> <span>"+(row.sat!==null?row.sat.split('|')[1]:'')+"</span></div>"+
                        "<div class='time-total'><b>TOTAL: </b> <span>"+(row.sat!==null?row.sat.split('|')[2]:'')+"</span></div>"+
                        "<div class='time-type'><b>TYPE: </b> <span>"+(row.sat!==null?row.sat.split('|')[3]:'')+"</span></div>"+
                        "</div>";
                return tag;
            }},
            { data: "status", title: "STATUS"},
            { data: "reg", title: "REG"},
            { data: "ot", title: "OT"},
            { data: "sick", title: "SICK"},
            { data: "vac", title: "VAC"},
            { data: "total", title: "TOTAL"}
        ], 'Bfrtip', ['csv', 'pdf']
    );
}
