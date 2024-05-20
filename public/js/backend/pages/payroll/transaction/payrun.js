$(function() {
    modal_content = 'payrun';
    module_url = '/payroll/payrun';
    module_type = 'transaction_2';
    page_title = "Add Payrun";

    scion.centralized_button(false, true, true, true);

});


// DEFAULT FUNCTION
function success(record) {}

function error() {}

function delete_success() {}

function delete_error() {}

function generateData() {}

function generateDeleteItems() {}

function modalShowFunction() {
    scion.centralized_button(true, false, true, true);
}

function modalHideFunction() {
    scion.centralized_button(false, true, true, true);
}


// OTHER FUNCTION
function selectPaymentSchedule() {
    if($('#payment_schedule').val() === 'weekly') {
        $('.days_select').css('display','block');
        console.log(getWeekDate($('#days').val()));
    }
    else {
        $('.days_select').css('display','none');
    }
}

function getWeekDate(day){
    var weekdate = moment()
        .startOf('month')
        .day(day);
    if (weekdate.date() > 7) weekdate.add(7,'d');
    var month = weekdate.month();
    var dateList = [];

    while(month === weekdate.month()){
        dateList.push(moment(weekdate.toString()).format('MMM DD'));
        weekdate.add(7,'d');
    }

    return dateList;
}