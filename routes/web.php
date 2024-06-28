<?php

use App\Events\FormSubmitted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
        // return view('backend.pages.dashboard');
        return view('backend.pages.payroll.transaction.employee.dashboard');
    });

    Route::get('/po-sample', function () {
        // return view('backend.pages.dashboard');
        return view('backend.partial.purchase_order');
    });

    Route::get('/dashboard', function () {
        return view('backend.pages.payroll.transaction.employee.dashboard');
    });

    Route::group(['prefix' => '/masterlist'], function() {
        Route::group(['prefix' => '/employee'], function (){
            Route::get              ('/',                        'EmployeeInformationController@masterlist'                     )->name('employee_masterlist');
            Route::get              ('/get',                     'EmployeeInformationController@getmasterlist'                  )->name('get_data');
        });
    });

    Route::group(['prefix' => '/api'], function (){
        Route::group(['prefix' => '/leave-type'], function (){
            Route::post         ('/getData',                     'LeaveTypeController@getData'                                  )->name('get_data_leave_type');
        });
    });

    Route::group(['prefix' => '/purchasing'], function (){
        Route::group(['prefix' => '/sites'], function (){
            Route::get          ('/',                            'SiteController@index'                                      )->name('classes');
            Route::get          ('/get',                         'SiteController@get'                                        )->name('get_classes');
            Route::post         ('/save',                        'SiteController@store'                                      )->name('save_classes');
            Route::get          ('/edit/{id}',                   'SiteController@edit'                                       )->name('edit_classes');
            Route::post         ('/update/{id}',                 'SiteController@update'                                     )->name('update_classes');
            Route::post         ('/destroy',                     'SiteController@destroy'                                    )->name('destroy_classes');
        });

        Route::group(['prefix' => '/supplier'], function (){
            Route::get          ('/',                            'SupplierController@index'                                      )->name('classes');
            Route::get          ('/get',                         'SupplierController@get'                                        )->name('get_classes');
            Route::post         ('/save',                        'SupplierController@store'                                      )->name('save_classes');
            Route::get          ('/edit/{id}',                   'SupplierController@edit'                                       )->name('edit_classes');
            Route::post         ('/update/{id}',                 'SupplierController@update'                                     )->name('update_classes');
            Route::post         ('/destroy',                     'SupplierController@destroy'                                    )->name('destroy_classes');
        });
    });

    Route::group(['prefix' => '/accounting'], function (){
        Route::group(['prefix' => '/chart_of_accounts'], function (){
            Route::get          ('/',                            'ChartOfAccountController@index'                                      )->name('classes');
            Route::get          ('/get',                         'ChartOfAccountController@get'                                        )->name('get_classes');
            Route::post         ('/save',                        'ChartOfAccountController@store'                                      )->name('save_classes');
            Route::get          ('/edit/{id}',                   'ChartOfAccountController@edit'                                       )->name('edit_classes');
            Route::post         ('/update/{id}',                 'ChartOfAccountController@update'                                     )->name('update_classes');
            Route::post         ('/destroy',                     'ChartOfAccountController@destroy'                                    )->name('destroy_classes');
        });

        Route::group(['prefix' => '/account_types'], function (){
            Route::get          ('/',                            'AccountTypeController@index'                                      )->name('classes');
            Route::get          ('/get',                         'AccountTypeController@get'                                        )->name('get_classes');
            Route::post         ('/save',                        'AccountTypeController@store'                                      )->name('save_classes');
            Route::get          ('/edit/{id}',                   'AccountTypeController@edit'                                       )->name('edit_classes');
            Route::post         ('/update/{id}',                 'AccountTypeController@update'                                     )->name('update_classes');
            Route::post         ('/destroy',                     'AccountTypeController@destroy'                                    )->name('destroy_classes');
        });
    });

    Route::group(['prefix' => '/payroll'], function (){
        Route::get          ('/',                                'PayrollController@index'                                      )->name('payroll');

        Route::group(['prefix' => '/global'], function() {
            Route::post         ('/getdatesanddays',             'GlobalController@getDateAndDays'                              )->name('get_date_and_days');
        });

        Route::group(['prefix' => '/employee-information'], function (){
            Route::get          ('/',                            'EmployeeInformationController@index'                          )->name('employment_information');
            Route::get          ('/get',                         'EmployeeInformationController@get'                            )->name('get_employment_information');
            Route::post         ('/save',                        'EmployeeInformationController@store'                          )->name('save_employment_information');
            Route::get          ('/edit/{id}',                   'EmployeeInformationController@edit'                           )->name('edit_employment_information');
            Route::post         ('/update/{id}',                 'EmployeeInformationController@update'                         )->name('update_employment_information');
            Route::post         ('/destroy',                     'EmployeeInformationController@destroy'                        )->name('destroy_employment_information');
        });

        Route::group(['prefix' => '/201-file'], function (){
            Route::get          ('/',                            'PersonnelFileController@index'                                )->name('employment_information');
            Route::get          ('/get',                         'PersonnelFileController@get'                                  )->name('get_employment_information');
            Route::post         ('/save',                        'PersonnelFileController@store'                                )->name('save_employment_information');
            Route::get          ('/edit/{id}',                   'PersonnelFileController@edit'                                 )->name('edit_employment_information');
            Route::post         ('/update/{id}',                 'PersonnelFileController@update'                               )->name('update_employment_information');
            Route::post         ('/destroy',                     'PersonnelFileController@destroy'                              )->name('destroy_employment_information');
        });

        Route::group(['prefix' => '/summary'], function() {
            Route::get          ('/',                            'PayrollSummaryController@index'                               )->name('payroll_summary');
            Route::post         ('/save',                        'PayrollSummaryController@save'                                )->name('save_earning_and_deduction');
            Route::get          ('/get',                         'PayrollSummaryController@get'                                 )->name('payroll_summary_get');
            Route::get          ('/get',                         'PayrollSummaryController@get'                                 )->name('payroll_summary_get');
            Route::get          ('/get_history',                 'PayrollSummaryController@get_history'                         )->name('payroll_summary_get');
            Route::post         ('/get_summary',                 'PayrollSummaryController@get_summary'                         )->name('payroll_summary_get');
            Route::get          ('/get_details/{sequence_no}',   'PayrollSummaryController@get_details'                         )->name('payroll_summary_get');
            Route::post         ('/get_earnings_and_deductions', 'PayrollSummaryController@get_earnings_and_deductions'         )->name('payroll_summary_get');
            Route::get          ('/get_earnings',                'PayrollSummaryController@get_earnings'                        )->name('earning_get');
            Route::get          ('/get_deductions',              'PayrollSummaryController@get_deductions'                      )->name('deduction_get');
            Route::post         ('/update_status',               'PayrollSummaryController@update_status'                       )->name('update_status_payroll_summary');
            Route::post         ('/update_details_status',       'PayrollSummaryController@update_details_status'               )->name('update_status_payroll_summary');
            Route::post         ('/get_overall',                 'PayrollSummaryController@get_overall'                         )->name('get_overall');
            Route::post         ('/show',                        'PayrollSummaryController@show'                                )->name('show_payroll_sumamry');
        });

        Route::group(['prefix' => '/sss'], function() {
            Route::get          ('/',                            'SSSController@index'                                          )->name('sss');
            Route::get          ('/get',                         'SSSController@get'                                            )->name('get_sss');
            Route::post         ('/generate',                    'SSSController@generateSSSTable'                               )->name('generate_sss');
        });

        Route::group(['prefix' => '/payslip'], function() {
            Route::get          ('/',                            'PayrollSummaryController@payslip'                             )->name('payslip');
        });

        Route::group(['prefix' => '/payroll_calendar'], function() {
            Route::get          ('/',                            'PayrollCalendarController@index'                              )->name('payroll_calendar');
            Route::get          ('/get',                         'PayrollCalendarController@get'                                )->name('get_payroll_calendar');
            Route::post         ('/save',                        'PayrollCalendarController@save'                               )->name('save_payroll_calendar');
            Route::get          ('/edit/{id}',                   'PayrollCalendarController@edit'                               )->name('edit_payroll_calendar');
            Route::post         ('/update/{id}',                 'PayrollCalendarController@update'                             )->name('update_payroll_calendar');
            Route::post         ('/destroy',                     'PayrollCalendarController@destroy'                            )->name('destroy_payroll_calendar');
        });

        Route::group(['prefix' => '/company-profile'], function (){
            Route::get          ('/',                            'CompanyProfileController@index'                               )->name('company_profile');
            Route::get          ('/get',                         'CompanyProfileController@get'                                 )->name('get_company_profile');
            Route::post         ('/save',                        'CompanyProfileController@store'                               )->name('save_company_profile');
            Route::get          ('/edit/{id}',                   'CompanyProfileController@edit'                                )->name('edit_company_profile');
            Route::post         ('/update/{id}',                 'CompanyProfileController@update'                              )->name('update_company_profile');
            Route::post         ('/destroy',                     'CompanyProfileController@destroy'                             )->name('destroy_company_profile');
        });

        Route::group(['prefix' => '/classes'], function (){
            Route::get          ('/',                            'ClassesController@index'                                      )->name('classes');
            Route::get          ('/get',                         'ClassesController@get'                                        )->name('get_classes');
            Route::post         ('/save',                        'ClassesController@store'                                      )->name('save_classes');
            Route::get          ('/edit/{id}',                   'ClassesController@edit'                                       )->name('edit_classes');
            Route::post         ('/update/{id}',                 'ClassesController@update'                                     )->name('update_classes');
            Route::post         ('/destroy',                     'ClassesController@destroy'                                    )->name('destroy_classes');
        });


        Route::group(['prefix' => '/department'], function (){
            Route::get          ('/',                            'DepartmentsController@index'                                  )->name('department');
            Route::get          ('/get',                         'DepartmentsController@get'                                    )->name('get_department');
            Route::post         ('/save',                        'DepartmentsController@store'                                  )->name('save_department');
            Route::get          ('/edit/{id}',                   'DepartmentsController@edit'                                   )->name('edit_department');
            Route::post         ('/update/{id}',                 'DepartmentsController@update'                                 )->name('update_department');
            Route::post         ('/destroy',                     'DepartmentsController@destroy'                                )->name('destroy_department');
        });

        Route::group(['prefix' => '/withholding_tax'], function (){
            Route::get          ('/',                            'WithholdingTaxController@index'                               )->name('withholding_tax');
            Route::get          ('/get',                         'WithholdingTaxController@get'                                 )->name('get_withholding_tax');
            Route::post         ('/save',                        'WithholdingTaxController@store'                               )->name('save_withholding_tax');
            Route::get          ('/edit/{id}',                   'WithholdingTaxController@edit'                                )->name('edit_withholding_tax');
            Route::post         ('/update/{id}',                 'WithholdingTaxController@update'                              )->name('update_withholding_tax');
            Route::post         ('/destroy',                     'WithholdingTaxController@destroy'                             )->name('destroy_withholding_tax');
        });

        Route::group(['prefix' => '/position'], function (){
            Route::get          ('/',                            'PositionsController@index'                                    )->name('position');
            Route::get          ('/get',                         'PositionsController@get'                                      )->name('get_position');
            Route::post         ('/save',                        'PositionsController@store'                                    )->name('save_position');
            Route::get          ('/edit/{id}',                   'PositionsController@edit'                                     )->name('edit_position');
            Route::post         ('/update/{id}',                 'PositionsController@update'                                   )->name('update_position');
            Route::post         ('/destroy',                     'PositionsController@destroy'                                  )->name('destroy_position');
        });

        Route::group(['prefix' => '/leave-type'], function (){
            Route::get          ('/',                            'LeaveTypeController@index'                                    )->name('leave_type');
            Route::get          ('/get',                         'LeaveTypeController@get'                                      )->name('get_leave_type');
            Route::post         ('/save',                        'LeaveTypeController@store'                                    )->name('save_leave_type');
            Route::get          ('/edit/{id}',                   'LeaveTypeController@edit'                                     )->name('edit_leave_type');
            Route::post         ('/update/{id}',                 'LeaveTypeController@update'                                   )->name('update_leave_type');
            Route::post         ('/destroy',                     'LeaveTypeController@destroy'                                  )->name('destroy_position');
        });

        Route::group(['prefix' => '/earnings'], function (){
            Route::get          ('/',                            'EarningsController@index'                                     )->name('earnings');
            Route::get          ('/get',                         'EarningsController@get'                                       )->name('get_earnings');
            Route::post         ('/save',                        'EarningsController@store'                                     )->name('save_earnings');
            Route::get          ('/edit/{id}',                   'EarningsController@edit'                                      )->name('edit_earnings');
            Route::post         ('/update/{id}',                 'EarningsController@update'                                    )->name('update_earnings');
            Route::post         ('/destroy',                     'EarningsController@destroy'                                   )->name('destroy_earnings');
        });

        Route::group(['prefix' => '/deductions'], function (){
            Route::get          ('/',                            'DeductionsController@index'                                   )->name('deductions');
            Route::get          ('/get',                         'DeductionsController@get'                                     )->name('get_deductions');
            Route::post         ('/save',                        'DeductionsController@store'                                   )->name('save_deductions');
            Route::get          ('/edit/{id}',                   'DeductionsController@edit'                                    )->name('edit_deductions');
            Route::post         ('/update/{id}',                 'DeductionsController@update'                                  )->name('update_deductions');
            Route::post         ('/destroy',                     'DeductionsController@destroy'                                 )->name('destroy_deductions');
        });

        Route::group(['prefix' => '/work_assignments'], function (){
            Route::get          ('/',                            'WorkAssignmentsController@index'                              )->name('work_assignments');
            Route::get          ('/get',                         'WorkAssignmentsController@get'                                )->name('get_work_assignments');
            Route::post         ('/save',                        'WorkAssignmentsController@store'                              )->name('save_work_assignments');
            Route::get          ('/edit/{id}',                   'WorkAssignmentsController@edit'                               )->name('edit_work_assignments');
            Route::post         ('/update/{id}',                 'WorkAssignmentsController@update'                             )->name('update_work_assignments');
            Route::post         ('/destroy',                     'WorkAssignmentsController@destroy'                            )->name('destroy_work_assignments');
        });

        Route::group(['prefix' => '/scheduling'], function (){
            Route::get          ('/',                                'SchedulingsController@index'                              )->name('scheduling');
            Route::get          ('/get/{department}/{first}/{last}', 'SchedulingsController@get'                                )->name('get_scheduling');
            Route::post         ('/save',                            'SchedulingsController@save'                               )->name('save_scheduling');
            Route::post         ('/copy_schedule',                   'SchedulingsController@copy_schedule'                      )->name('copy_schedule');
            Route::post         ('/paste_schedule',                  'SchedulingsController@paste_schedule'                     )->name('paste_schedule');
        });

        Route::group(['prefix' => '/time_logs'], function (){
            Route::get          ('/',                                 'TimeLogsController@index'                                )->name('time_logs');
            Route::get          ('/get/{department}/{first}/{last}',  'TimeLogsController@get'                                  )->name('get_time_logs');
            Route::get          ('/plot/{employee}/{first}/{last}',   'TimeLogsController@plot'                                 )->name('get_time_plotting_employee');
            Route::post         ('/earnings',                         'TimeLogsController@get_earnings'                         )->name('get_earnings');
            Route::post         ('/save',                             'TimeLogsController@save'                                 )->name('save_time_logs');
            Route::post         ('/update-status',                    'TimeLogsController@update_status'                        )->name('update_status');
            Route::post         ('/cross-matching',                   'TimeLogsController@cross_matching'                       )->name('cross_matching');
        });

        Route::group(['prefix' => '/benefits'], function (){
            Route::get          ('/',                            'BenefitsController@index'                                     )->name('benefits');
            Route::get          ('/get',                         'BenefitsController@get'                                       )->name('get_benefits');
            Route::post         ('/save',                        'BenefitsController@store'                                     )->name('save_benefits');
            Route::get          ('/edit/{id}',                   'BenefitsController@edit'                                      )->name('edit_benefits');
            Route::post         ('/update/{id}',                 'BenefitsController@update'                                    )->name('update_benefits');
            Route::post         ('/destroy',                     'BenefitsController@destroy'                                   )->name('destroy_benefits');
            Route::post         ('/governmentMandated',          'BenefitsController@governmentMandatedBenefits'                )->name('get_government_mandated_benefits');
            Route::post         ('/otherCompany',                'BenefitsController@otherCompanyBenefits'                      )->name('get_other_company_benefits');
        });

        Route::group(['prefix' => '/employment'], function (){
            Route::post          ('/update/{id}',                'EmploymentController@save'                                    )->name('save_employment');
            Route::post          ('/destroy',                    'EmploymentController@destroy'                                 )->name('destroy_employment');
        });

        Route::group(['prefix' => '/leaves'], function (){
            Route::post          ('/update/{id}',                'LeavesController@save'                                        )->name('save_employment');
            Route::get           ('/get/{id}',                   'LeavesController@get'                                         )->name('get_leaves');
            Route::post          ('/destroy',                    'LeavesController@destroy'                                     )->name('destroy_leaves');
        });

        Route::group(['prefix' => '/compensation'], function (){
            Route::post          ('/update/{id}',                'CompensationsController@save'                                 )->name('save_employment');
            Route::get           ('/get-gov-record/{id}',        'CompensationsController@getGovernmentMandatedRecord'          )->name('get_government_mandated_record');
            Route::get           ('/get-com-record/{id}',        'CompensationsController@getCompanyBenefits'                   )->name('get_government_mandated_record');
            Route::post          ('/destroy',                    'CompensationsController@destroy'                              )->name('destroy_leaves');
            Route::post          ('/salary',                     'CompensationsController@salary'                               )->name('get_salaries');
        });

        Route::group(['prefix' => '/work-calendar'], function (){
            Route::post          ('/update/{id}',                'WorkCalendarController@save'                                  )->name('save_employment');
        });
    });

    Route::group(['prefix' => '/settings'], function (){

        Route::group(['prefix' => '/apps'], function (){
            Route::get          ('/',                            'AppController@index'                                          )->name('classes');
            Route::get          ('/get',                         'AppController@get'                                            )->name('get_classes');
            Route::post         ('/save',                        'AppController@store'                                          )->name('save_classes');
            Route::get          ('/edit/{id}',                   'AppController@edit'                                           )->name('edit_classes');
            Route::post         ('/update/{id}',                 'AppController@update'                                         )->name('update_classes');
            Route::get          ('/destroy/{id}',                'AppController@destroy'                                        )->name('destroy_classes');
        });

        Route::group(['prefix' => '/app_items'], function (){
            Route::get          ('/',                            'AppItemController@index'                                         )->name('classes');
            Route::get          ('/get',                         'AppItemController@get'                                           )->name('get_classes');
            Route::post         ('/save',                        'AppItemController@store'                                         )->name('save_classes');
            Route::get          ('/edit/{id}',                   'AppItemController@edit'                                          )->name('edit_classes');
            Route::post         ('/update/{id}',                 'AppItemController@update'                                        )->name('update_classes');
            Route::get          ('/destroy/{id}',                'AppItemController@destroy'                                       )->name('destroy_classes');
        });

        Route::group(['prefix' => '/users'], function (){
            Route::get          ('/',                            'UserController@index'                                         )->name('classes');
            Route::get          ('/get',                         'UserController@get'                                           )->name('get_classes');
            Route::post         ('/save',                        'UserController@store'                                         )->name('save_classes');
            Route::get          ('/edit/{id}',                   'UserController@edit'                                          )->name('edit_classes');
            Route::post         ('/update/{id}',                 'UserController@update'                                        )->name('update_classes');
            Route::get          ('/destroy/{id}',                'UserController@destroy'                                       )->name('destroy_classes');
        });

        Route::group(['prefix' => '/role'], function (){
            Route::get          ('/',                            'RolesController@index'                                        )->name('employment_information');
            Route::get          ('/get',                         'RolesController@get'                                           )->name('get_classes');
            Route::post         ('/save',                        'RolesController@store'                                        )->name('save_employment_information');
            Route::get          ('/edit/{id}',                   'RolesController@edit'                                         )->name('edit_employment_information');
            Route::post         ('/update/{id}',                 'RolesController@update'                                       )->name('update_employment_information');
            Route::get          ('/destroy/{id}',                'RolesController@destroy'                                      )->name('destroy_employment_information');
        });

        Route::group(['prefix' => '/permission'], function (){
            Route::get          ('/',                            'PermissionController@index'                                        )->name('employment_information');
            Route::get          ('/get',                         'PermissionController@get'                                          )->name('get_classes');
            Route::post         ('/save',                        'PermissionController@store'                                        )->name('save_employment_information');
            Route::get          ('/edit/{id}',                   'PermissionController@edit'                                         )->name('edit_employment_information');
            Route::post         ('/update/{id}',                 'PermissionController@update'                                       )->name('update_employment_information');
            Route::get          ('/destroy/{id}',                'PermissionController@destroy'                                      )->name('destroy_employment_information');
        });

    });
});


// EMPLOYEE UI

Route::get('/payroll/employee/dashboard', function() {
    return view('backend.pages.payroll.transaction.employee.dashboard');
});

Route::get('/payroll/employee/overtime_application', function() {
    return view('backend.pages.payroll.transaction.employee.overtime_application');
});

Route::get('/payroll/employee/leave_application', function() {
    return view('backend.pages.payroll.transaction.employee.leave_application');
});

Route::get('/payroll/employee/reimbursement', function() {
    return view('backend.pages.payroll.transaction.employee.reimbursement');
});

Route::get('/payroll/employee/leave_monetization', function() {
    return view('backend.pages.payroll.transaction.employee.leave_monetization');
});

Route::get('/payroll/employee/leave_management', function() {
    return view('backend.pages.payroll.transaction.employee.leave_management');
});

Route::get('/payroll/employee/employee_reports', function() {
    return view('backend.pages.payroll.transaction.employee.employee_reports');
});

// END EMPLOYEE UI

Route::post('/sender', function() {
    $text = request()->text;
    event(new FormSubmitted($text));
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes();


Route::post('change-password', 'UserController@changepass')->name('change.password');
Route::post('change-photo', 'UserController@changePicture')->name('change.picture');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
