<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-toggle mr-2">
            <i class="fas fa-bars"></i>
        </a>

        <div class="company-logo">
            <img src="/images/logo.png" class="logo1" alt="company-logo" width="100%"/>
            <img src="/images/logo-2.png" class="logo2" alt="company-logo-2" width="100%"/>
            <div class="company-name">
                Company Name
            </div>
        </div>


        <ul class="sidebar-nav" style="overflow-x: hidden;">
            <li class="sidebar-header">
                MAIN
            </li>
            <li class="sidebar-item">
                <a href="#dashboard" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-tachometer-alt"></i> <span class="align-middle">DASHBOARD</span>
                    </span>
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                    <li class="list-title">DASHBOARD</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/dashboard">MAIN</a></li>
                </ul>

                <a href="#employee" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-user"></i> <span class="align-middle">EMPLOYEE</span>
                    </span>
                </a>
                <ul id="employee" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">EMPLOYEE</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/employee-information">EMPLOYEE PROFILE</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/201-file">201 FILE</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/masterlist/employee">EMPLOYEE MASTERLIST</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                TRANSACTION
            </li>

            <li class="sidebar-item">
                <a href="#payroll_system" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-receipt"></i> <span class="align-middle">PAYROLL</span>
                    </span>
                </a>
                <ul id="payroll_system" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">PAYROLL</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/summary">PAYROLL SUMMARY</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/time_logs">TIME LOGS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/work_schedule">WORK SCHEDULE</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/scheduling">SCHEDULING</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/project_time">PROJECT TIME</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#accounting" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-money-bill"></i> <span class="align-middle">ACCOUNTING</span>
                    </span>
                </a>
                <ul id="accounting" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">ACCOUNTING</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/accounting/chart_of_accounts">CHART OF ACCOUNTS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/accounting/account_types">ACCOUNT TYPE</a></li>
                </ul>
            </li>


            <li class="sidebar-item">
                <a href="#purchasing" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-shopping-basket"></i> <span class="align-middle">PURCHASING</span>
                    </span>
                </a>
                <ul id="purchasing" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">PURCHASING</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/purchasing/sites">SITE</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/purchasing/supplier">SUPPLIER</a></li>
                </ul>
            </li>


            <li class="sidebar-header">
                SETUP
            </li>
            <li class="sidebar-item">
                <a href="#organizational_setup" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-list-alt"></i> <span class="align-middle">ORGANIZATION</span>
                    </span>
                </a>
                <ul id="organizational_setup" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">ORGANIZATIONAL SETUP</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/company-profile">COMPANY PROFILE</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/classes">CLASSES</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/department">DEPARTMENTS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/position">POSITIONS</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#payroll_setup" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-list-alt"></i> <span class="align-middle">PAYROLL</span>
                    </span>
                </a>
                <ul id="payroll_setup" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">PAYROLL SETUP</li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/payroll_calendar">PAYROLL CALENDAR</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/earnings">EARNINGS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/deductions">DEDUCTIONS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/work_assignments">WORK ASSIGNMENTS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/withholding_tax">WITHHOLDING TAX</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/reimbursements">REIMBURSEMENT</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/benefits">BENEFITS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/leave-type">LEAVE TYPES</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/sss">SSS</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/philhealth">PHILHEALTH</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/payroll/pagibig">PAG-IBIG</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#employee_setup" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-list-alt"></i> <span class="align-middle">EMPLOYEE</span>
                    </span>
                </a>
                <ul id="employee_setup" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="list-title">EMPLOYEE SETUP</li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#roles_permission" data-toggle="collapse" class="sidebar-link collapsed">
                    <span class="item">
                        <i class="align-middle mr-2 fas fa-fw fa-list-alt"></i> <span class="align-middle">USER ACCESS</span>
                    </span>
                </a>
            </li>

        </ul>
    </div>
</nav>
