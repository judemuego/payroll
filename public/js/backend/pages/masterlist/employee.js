$(function() {
    modal_content = 'employee';
    module_url = '/masterlist/employee';
    module_type = 'custom';
    page_title = "Employee Masterlist";

    scion.centralized_button(true, true, true, true);
    scion.create.table(
        'employee_table',  
        module_url + '/get', 
        [
            // { data: "id", title:"<input type='checkbox' class='multi-checkbox' onclick='scion.table.checkAll()'/>", render: function(data, type, row, meta) {
            //     var html = "";
            //     html += '<input type="checkbox" class="single-checkbox" value="'+row.id+'" onclick="scion.table.checkOne()"/>';
            //     html += '<a href="#" class="align-middle edit" onclick="scion.record.edit('+"'/payroll/benefits/edit/', "+ row.id +')"><i class="fas fa-pen"></i></a>';
            //     return html;
            // }},
            { data: "employee_no", title:"EMPLOYEE NO." },
            { data: "profile_img", title: "", render: function(data, type, row, meta) {
                return "<img height='50px' src='/images/payroll/employee-information/" + row.profile_img + "' />";
            }},
            { data: "firstname", title: "NAME", render: function(data, type, row, meta) {
                return row.firstname + " " + (row.middlename !== null && row.middlename !== ""?row.middlename + " ":"") + row.lastname + (row.suffix !== null && row.suffix !== ""?row.suffix + "":"");
            }},
            { data: "email", title: "EMAIL" },
            { data: "birthdate", title: "BIRTHDATE", render: function(data, type, row, meta) {
                return moment(row.birthdate).format('MMM DD, YYYY');
            }},
            { data: "gender", title: "GENDER" },
            { data: "citizenship", title: "CITIZENSHIP" },
            { data: "created_at", title: "CREATED DATE", render: function(data, type, row, meta) {
                return moment(row.created_at).format('MMM DD, YYYY hh:mm A');
            }},
        ], 'Bfrtip', []
    );

});
