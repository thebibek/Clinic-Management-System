<!--START OF NAVBAR-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url("app/dashboard");?>"><img src="<?php echo base_url("assets/img/logo.png");?>" width="50" height="50"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="<?php echo base_url("app/dashboard"); ?>" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Masters</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url("app/category"); ?>"><img src="<?php echo base_url("assets/img/icons/category.png"); ?>"> &nbsp;|&nbsp; Category</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/unit"); ?>"><img src="<?php echo base_url("assets/img/icons/unit2.png"); ?>"> &nbsp;|&nbsp; Units</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/department"); ?>"><img src="<?php echo base_url("assets/img/icons/department.png"); ?>"> &nbsp;|&nbsp; Department</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/test"); ?>"><img src="<?php echo base_url("assets/img/icons/test.png"); ?>"> &nbsp;|&nbsp; Test</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/test/particulars"); ?>"><img src="<?php echo base_url("assets/img/icons/test1.png"); ?>"> &nbsp;|&nbsp; Test Particulars</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/blood/group"); ?>"><img src="<?php echo base_url("assets/img/icons/blood.png"); ?>"> &nbsp;|&nbsp; Blood Group</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/payment/mode"); ?>"><img src="<?php echo base_url("assets/img/icons/pmode3.png"); ?>"> &nbsp;|&nbsp; Payment Mode</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/nationality"); ?>"><img src="<?php echo base_url("assets/img/icons/passport.png"); ?>"> &nbsp;|&nbsp; Nationality</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Doctor</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/doctor'); ?>"><img  src="<?php echo base_url("assets/img/icons/doctor1.png"); ?>"> &nbsp;|&nbsp; Doctors</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('app/doctor'); ?>"><img  src="<?php echo base_url("assets/img/icons/add1.png"); ?>"> &nbsp;|&nbsp; Add Doctor</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/doctor/commision"); ?>"><img src="<?php echo base_url("assets/img/icons/commission.png"); ?>"> &nbsp;|&nbsp; Doctor Commision</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/doctor/report"); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Report</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Patient </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url("app/patient/registration"); ?>"><img src="<?php echo base_url("assets/img/icons/patient2.png"); ?>"> &nbsp;|&nbsp; Patients</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/patient/registration"); ?>"><img src="<?php echo base_url("assets/img/icons/registration.png"); ?>"> &nbsp;|&nbsp; Registration</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/patient/visits"); ?>"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"> &nbsp;|&nbsp; Visit Details</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/patient/report"); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Report Manager</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Invoice</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/receipt'); ?>"><img  src="<?php echo base_url("assets/img/icons/invoice1.png"); ?>"> &nbsp;|&nbsp; Create Invoice</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/bills"); ?>"><img src="<?php echo base_url("assets/img/icons/bill2.png"); ?>"> &nbsp;|&nbsp; Bills</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/bill/report"); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Business Report</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pathology</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/report'); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Pathology Report</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/pending/report"); ?>"><img src="<?php echo base_url("assets/img/icons/bill2.png"); ?>"> &nbsp;|&nbsp; Pending Report</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/complete/report"); ?>"><img src="<?php echo base_url("assets/img/icons/complete.png"); ?>"> &nbsp;|&nbsp; Completed Report</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/find/report"); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Finding Report</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/filter/pathology/report"); ?>"><img src="<?php echo base_url("assets/img/icons/report8.png"); ?>"> &nbsp;|&nbsp; Report Manager</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ledger</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/ledger/under/group'); ?>"><img  src="<?php echo base_url("assets/img/icons/ledger3.png"); ?>"> &nbsp;|&nbsp; Group</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/ledger/group"); ?>"><img src="<?php echo base_url("assets/img/icons/bill2.png"); ?>"> &nbsp;|&nbsp; Ledger Group</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/ledger/"); ?>"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> &nbsp;|&nbsp; Ledger</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Supplier</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/item/type'); ?>"><img  src="<?php echo base_url("assets/img/icons/itemtype1.png"); ?>"> &nbsp;|&nbsp; Item Type</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/item/vendor"); ?>"><img src="<?php echo base_url("assets/img/icons/supplier2.png"); ?>"> &nbsp;|&nbsp; Vendor</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/item/master"); ?>"><img src="<?php echo base_url("assets/img/icons/purchase2.png"); ?>"> &nbsp;|&nbsp; Item Master</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Purchase </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url("app/item/inward"); ?>"><img src="<?php echo base_url("assets/img/icons/purchase3.png"); ?>"> &nbsp;|&nbsp; Item Inward</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/manage/purchase"); ?>"><img src="<?php echo base_url("assets/img/icons/purchase4.png"); ?>"> &nbsp;|&nbsp; Manage Purchase</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/purchase/report"); ?>"><img src="<?php echo base_url("assets/img/icons/purchase6.png"); ?>"> &nbsp;|&nbsp; Purchase Report</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Accounts </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/account/voucher/entry'); ?>"><img  src="<?php echo base_url("assets/img/icons/voucher2.png"); ?>"> &nbsp;|&nbsp; Voucher Entry</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/account/day/book"); ?>"><img src="<?php echo base_url("assets/img/icons/ledger1.png"); ?>"> &nbsp;|&nbsp; Day Book</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/account/trial/balance"); ?>"><img src="<?php echo base_url("assets/img/icons/balance1.png"); ?>"> &nbsp;|&nbsp; Trial Balance </a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('app/account/cash/bank/book'); ?>"><img  src="<?php echo base_url("assets/img/icons/cashbook.png"); ?>"> &nbsp;|&nbsp; Cash & Bank Book</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/account/profit/loss"); ?>"><img src="<?php echo base_url("assets/img/icons/profit2.png"); ?>"> &nbsp;|&nbsp; Profit & Loss</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/account/balance/sheet"); ?>"><img src="<?php echo base_url("assets/img/icons/balance3.png"); ?>"> &nbsp;|&nbsp; Balance Sheet</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/account/delete/voucher"); ?>"><img src="<?php echo base_url("assets/img/icons/voucher2.png"); ?>"> &nbsp;|&nbsp; Delete Voucher</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white"  href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">HRM</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('app/employee/registration'); ?>"><img  src="<?php echo base_url("assets/img/icons/employee.png"); ?>"> &nbsp;|&nbsp; Employee Registration</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/search"); ?>"><img src="<?php echo base_url("assets/img/icons/employee2.png"); ?>"> &nbsp;|&nbsp; Employee Details</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/import"); ?>"><img src="<?php echo base_url("assets/img/icons/import.png"); ?>"> &nbsp;|&nbsp; Employee Import</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/designation"); ?>"><img src="<?php echo base_url("assets/img/icons/designation1.png"); ?>"> &nbsp;|&nbsp; Dept/Designation</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/attendance"); ?>"><img src="<?php echo base_url("assets/img/icons/attandance1.png"); ?>"> &nbsp;|&nbsp; Employee Attendance</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/salary/scheme"); ?>"><img src="<?php echo base_url("assets/img/icons/scheme1.png"); ?>"> &nbsp;|&nbsp; Salary Scheme</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/add/employee/salary/scheme"); ?>"><img src="<?php echo base_url("assets/img/icons/scheme2.png"); ?>"> &nbsp;|&nbsp; Employee Salary Scheme</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/salary/generation"); ?>"><img src="<?php echo base_url("assets/img/icons/salary2.png"); ?>"> &nbsp;|&nbsp; Salary Generation</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/salary/slip/payment"); ?>"><img src="<?php echo base_url("assets/img/icons/salary3.png"); ?>"> &nbsp;|&nbsp; Salary Slip/Payment</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/daily/attendance"); ?>"><img src="<?php echo base_url("assets/img/icons/attandance1.png"); ?>"> &nbsp;|&nbsp; Daily Attendence</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/fill/employee/attendance"); ?>"><img src="<?php echo base_url("assets/img/icons/attendance1.png"); ?>"> &nbsp;|&nbsp; Fill Attendence</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/assign/leave"); ?>"><img src="<?php echo base_url("assets/img/icons/leave1.png"); ?>"> &nbsp;|&nbsp; Leave Assign</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/assign/employee/leave"); ?>"><img src="<?php echo base_url("assets/img/icons/leave2.png"); ?>"> &nbsp;|&nbsp; Employee Leave Assign</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/leave/application"); ?>"><img src="<?php echo base_url("assets/img/icons/leaveapp1.png"); ?>"> &nbsp;|&nbsp; Leave Application</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/advance/payment"); ?>"><img src="<?php echo base_url("assets/img/icons/advance1.png"); ?>"> &nbsp;|&nbsp; Advance Paid</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url("app/employee/security/deposit"); ?>"><img src="<?php echo base_url("assets/img/icons/security.png"); ?>"> &nbsp;|&nbsp; Security Deposit</a></li>
                    </ul>
                </li>

                <?php
                if ($this->aauth->is_admin()) {
                    ?>
                    <li class="nav-item"><a href="<?php echo base_url('app/settings'); ?>" class="nav-link text-white">Settings</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('app/user/management'); ?>" class="nav-link text-white">User Management</a></li>
                        <?php
                    }
                    ?>
            </ul>
        </div>
    </div>
</nav>





<!--END OF NAVBAR-->