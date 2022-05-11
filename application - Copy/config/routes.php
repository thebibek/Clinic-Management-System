<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route["default_controller"] = "InstallController";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//dashboard
$route['app/dashboard']="DashboardController";
$route['api/provide/today/patient/visits'] = "DashboardController/provideTodayPatientVisits";
$route['app/provide/next/day/patient/visit'] = "DashboardController/provideNextVisits";
$route['app/provide/previous/day/patient/visit'] = "DashboardController/providePreviousVisits";
$route['app/provide/today/completed/report'] = "DashboardController/provideTodayCompletedReport";
$route['app/provide/today/test/invoice'] = "DashboardController/provideTodaysTestInvoice";
$route['app/provide/employee/today/status']="DashboardController/provideTodaysEmployeeStatus";

//master routes
$route['app/test']="TestController";
$route['app/category']="CategoryController";
$route['app/category/save']="CategoryController/saveCategory";
$route['app/category/edit']="CategoryController/editCategory";
$route['app/category/update']="CategoryController/updateCategory";
$route['app/delete/category']="CategoryController/deleteCategory";
$route['api/v1/app/master']="MasterController/getMaster";
$route['app/blood/group'] = "BloodGroupController/index";
$route['app/save/blood/group']="BloodGroupController/saveBloodGroup";
$route['app/delete/blood/group'] = "BloodGroupController/deleteBloodGroup";
$route['app/edit/blood/group'] = "BloodGroupController/editBloodGroup";
$route['app/update/blood/group'] = "BloodGroupController/updateBloodGroup";
$route['app/payment/mode'] = "PaymentController/showModeView";
$route['app/save/payment/mode'] = "PaymentController/savePaymentMode";
$route['app/edit/payment/mode'] = "PaymentController/editPaymentMode";
$route['app/update/payment/mode'] = "PaymentController/updatePaymentMode";
$route['app/delete/payment/mode'] = "PaymentController/deletePaymentMode";
$route['app/nationality'] = "NationalityController/index";
$route['app/save/nationality']="NationalityController/saveNationality";
$route['app/delete/nationality'] = "NationalityController/deleteNationality";
$route['app/edit/nationality'] = "NationalityController/editNationality";
$route['app/update/nationality'] = "NationalityController/updateNationality";


//patient

$route['app/patient/registration']="PatientController";
$route['api/v1/app/get/year/month/day']="UtilityController/getYear";
$route['app/save/patient']="PatientController/savePatient";
$route['app/patient/profile/(:num)'] = "PatientController/showProfile/$1";
$route['app/get/single/patient'] = "PatientController/getPatient";
$route['app/patient/visits'] = "PatientController/visit";
$route['app/patient/fetch/visits']="PatientController/getVisits";
$route['app/edit/patient']="PatientController/editPatient";
$route['app/update/patient']="PatientController/updatePatient";
$route['app/patient/report']="ReportManagerController/patientReport";
$route['app/patient/report/month/wise/visit']="ReportManagerController/getMonthlyPatientVisits";
$route['app/patient/wise/monthly/collection']="ReportManagerController/getMonthlyCollection";
$route['app/date/wise/patient/visit']="ReportManagerController/getDateVisits";


//doctor master 
$route['app/doctor']="DoctorController";
$route['app/save/doctor']="DoctorController/saveDoctor";
$route['app/edit/doctor']="DoctorController/editDoctor";
$route['app/update/doctor']="DoctorController/updateDoctor";
$route['app/delete/doctor']="DoctorController/deleteDoctor";
$route['app/doctor/report'] = "DoctorController/doctorReportView";
$route['app/provide/month/wise/commission'] = "DoctorReportController/monthWiseCommission";
$route['app/provide/month/wise/doctor/commission'] = "DoctorReportController/monthlyDoctorCommission";
$route['app/provide/date/wise/doctor/commission'] = "DoctorReportController/dateWiseDoctorCommission";

//doctor commision route
$route['app/doctor/commision']="DoctorController/showCommision";
$route['app/delete/doctor/commission']="DoctorController/deleteCommision";
$route['app/edit/doctor/commission']="DoctorController/editCommission";
$route['app/update/doctor/commision']="DoctorController/updateCommission";
$route['app/pay/doctor/commission']="DoctorController/payCommission";



//units master
$route['app/unit']="UnitController";
$route['app/unit/save']="UnitController/saveUnit";
$route['app/delete/unit']="UnitController/deleteUnit";
$route['app/unit/edit']="UnitController/editUnit";
$route['app/unit/update']="UnitController/updateUnit";

//department master
$route['app/department']="DepartmentController";
$route['app/department/save']="DepartmentController/saveDepartment";
$route['app/department/edit']="DepartmentController/editDepartment";
$route['app/department/update']="DepartmentController/updateDepartment";
$route['app/delete/department']="DepartmentController/deleteDepartment";

//save test
$route['app/test/save']="TestController/saveTest";
$route['app/test/edit']="TestController/editTest";
$route['app/test/update']="TestController/updateTest";
$route['app/test/delete']="TestController/deleteTest";

//test particulras
$route['app/test/particulars']="TestParticularsController";
$route['app/test/particulars/save']="TestParticularsController/saveTestParticulars";
$route['app/test/particulars/fetch']="TestParticularsController/fetchTestParticulars";
$route['app/particulars/delete']="TestParticularsController/deleteParticulars";

//print route
//$route['app/print/bill']="PrintController/printBill";
$route['app/print/bill/([A-Za-z0-9_-]+$)']='PrintController/printBill/$1'; 
$route['app/print/report/([A-Za-z0-9_-]+$)']="PrintController/printReport/$1";
$route['app/particulars/edit']="TestParticularsController/editTestParticulars";
$route['app/testparticulars/update']="TestParticularsController/updateTestParticulars";


//receipt route
$route['app/receipt']="ReceiptController";
$route['app/bill/save']="ReceiptController/saveBill";
$route['app/bills']="ReceiptController/getBills";
$route['app/delete/receipt']="ReceiptController/deleteReceipt";
$route['app/single/receipt/data']="ReceiptController/getReceipt";
$route['app/save/due/fee']="ReceiptController/saveDueFee";
$route['app/edit/bill']="ReceiptController/editBill";
$route['app/update/bill']="ReceiptController/updateBill";
$route['app/bill/report']="ReportManagerController/billReport";
$route['app/month/bill/report']="ReportManagerController/monthBillCollection";
$route['app/date/wise/collection']="ReportManagerController/dateWiseCollection";


//report route 
$route['app/report']="ReportController";
$route['app/report/pending/([A-Za-z0-9_-]+$)']="ReportController/generateReport/$1";
$route['app/report/tests']="ReportController/getReportTests";
$route['app/report/test/particulars']="ReportController/getReportParticulars";
$route['app/report/patient']="ReportController/getPatientInfo";
$route['app/save/test/result']="ReportController/saveTestResult";
$route['app/pending/report']="ReportController/pendingReports";
$route['app/complete/report']="ReportController/completeReports";
$route['app/find/report']="ReportController/searchReport";
$route['app/filter/pathology/report']="ReportManagerController/pathoReport";
$route['app/month/wise/completed/pathology/report']="ReportManagerController/monthlyCompletedReport";
$route['app/month/wise/pending/pathology/report']="ReportManagerController/monthlyPendingReport";
$route['app/date/wise/completed/report']="ReportManagerController/currentCompletedReport";
$route['app/date/wise/pending/report']="ReportManagerController/currentPendingReport";
$route['app/patient/receipt/reports']="ReportController/getSearchReports";


//settings route
$route['app/settings']="SettingsController";
$route['app/settings/save']="SettingsController/saveSettings";
$route['app/save/global/setting']="SettingsController/saveGlobalSetting";

//installer api
$route['install/require']="InstallController/firstStep";
$route['install/database']="InstallController/secondStep";
$route['install/validate/database']="InstallController/validateDatabase";
$route['install/setup']="InstallController/setup";
$route['install/validate/setup']="InstallController/setupValidate";
$route['install/finish']="InstallController/finishSetup";

//login route
$route['app/login']="AuthController/login";
$route['app/logout']="AuthController/logout";

//route for api search
$route['api/v1/app/test']="TestController/searchTest";

//user management route
$route['app/user/management']="UserController";
$route['app/users']="UserController/getUsers";
$route['app/save/user/group']="UserController/saveGroup";
$route['app/delete/user/group'] = "UserController/deleteUserGroup";
$route['app/group/edit']="UserController/editGroup";
$route['app/group/update']="UserController/updateGroup";
$route['app/delete/user'] = "UserController/deleteUser";
$route['app/user/save']="UserController/createUser";
$route['app/user/edit']="UserController/editUser";
$route['app/user/update']="UserController/updateUser";
$route['app/assign/user']="UserController/assignUser";
$route['app/save/permission']="UserController/savePermission";
$route['app/edit/permission']="UserController/editPermission";
$route['app/update/permission']="UserController/updatePermission";
$route['app/assign/perm']="UserController/assignPermission";
$route['app/user/permission/edit/(:num)']="UserController/editUserPermission/$1";
$route['app/change/password']="UserController/changePassword";
$route['app/link/user/to/employee'] = "UserController/linkUser";
$route['app/provide/linked/user'] = "UserController/provideLinkedUser";
$route['app/unlink/user'] = "UserController/updateUserLink";





//printing
$route['app/doctor/list/print']="ListController/printDoctorList";
$route['app/patient/list/print']="ListController/printPatientList";


//test route
$route['api/testing']="UserController/test";

//Ledger Group Under Group
$route['app/ledger/under/group']="GroupController";
$route['app/group/save']="GroupController/saveGroup";
$route['app/delete/ledger/under/group']="GroupController/deleteGroup";
$route['app/edit/ledger/under/group']="GroupController/editGroup";
$route['app/update/ledger/under/group']="GroupController/updateGroup";

//ledger group 
$route['app/ledger/group']="LedgerGroupController";
$route['app/ledger/group/save']="LedgerGroupController/saveLedgerGroup";
$route['app/get/ledger/groups']="LedgerGroupController/getLedgerGroups";
$route['app/get/ledger/master/groups']="LedgerGroupController";
$route['app/search/ledger/group']="LedgerGroupController/searchLedgerGroups";
$route['app/provide/group/ledgers'] = "LedgerGroupController/provideGroupLedgers";
$route['app/delete/ledger/group']= "LedgerGroupController/deleteLedgerGroup";
$route['app/edit/ledger/group']="LedgerGroupController/editLedgerGroup";
$route['app/update/ledger/group']="LedgerGroupController/updateLedgerGroup";

//ledger
$route['app/ledger']="LedgerController";
$route['app/ledger/save']="LedgerController/saveLedger";
$route['app/provide/ledger'] = "LedgerController/provideLedger";
$route['app/filter/account/ledger'] = "LedgerController/filterLedger";
$route['app/delete/ledger']="LedgerController/deleteLedger";
$route['app/edit/ledger'] = "LedgerController/editLedger";
$route['app/update/ledger']="LedgerController/updateLedger";


//item type route
$route['app/item/type']="ItemController";
$route['app/item/type/save']="ItemController/saveItemType";
$route['app/delete/item/type'] = "ItemController/deleteItemType";
$route['app/edit/item/type'] = "ItemController/editItemType";
$route['app/update/item/type']="ItemController/updateItemType";
$route['app/item/vendor']="VendorController";
$route['app/item/vendor/save']="VendorController/saveVendor";
$route['app/delete/vendor'] = "VendorController/deleteVendor";
$route['app/edit/vendor'] = "VendorController/editVendor";
$route['app/update/vendor'] = "VendorController/updateVendor";

// item route
$route['app/item/master']="ItemController/createItem";
$route['app/item/save']="ItemController/saveItem";
$route['app/delete/item'] = "ItemController/deleteItem";
$route['app/edit/item'] = "ItemController/editItem";
$route['app/update/item'] = "ItemController/updateItem";


//item inward
$route['app/item/inward']="PurchaseController/inwardItem";
$route['app/itemtype/itemname/provide']="PurchaseController/getItemName";
$route['app/validate/purchase/item']="PurchaseController/validatePurchaseItem";
$route['app/purchase/items/save']="PurchaseController/savePurchaseItems";
$route['app/delete/purchase/bill'] = "PurchaseController/deletePurchaseBill";
$route['app/edit/purchase/bill'] = "PurchaseController/editPurchaseBill";
$route['app/update/purchase/items'] = "PurchaseController/updatePurchaseItems";
$route['app/purchase/bills/provide']="PurchaseController/providePurchaseBills";
$route['app/manage/purchase']="PurchaseController/managePurchase";
$route['app/filter/puchase/bill']="PurchaseController/filterPurchaseBills";
$route['app/search/purchase/bill'] = "PurchaseController/findBill";
$route['app/purchase/bill/view/(:num)']="PurchaseController/viewPurchaseBill/$1";
$route['app/purchase/bill/print/(:num)']="PurchasePrintController/printPurchaseBill/$1";
$route['app/purchase/report']= "PurchaseController/purchaseReport";
$route['app/purchase/report/generate']="PurchaseController/generateReport";


//Employee route
$route['app/employee/registration'] = "EmployeeController/registration";
$route['app/employee/experience/years']="EmployeeController/experienceYears";
$route['app/save/employee']="EmployeeController/saveEmployee";
$route['app/delete/employee'] = "EmployeeController/deleteEmployee";
$route['app/update/employee'] = "EmployeeController/updateEmployee";
$route['app/employee/search']="EmployeeController/searchEmployee";
$route['app/employee/filter/result']="EmployeeController/filterEmployee";
$route['app/employee/import']="EmployeeController/importEmployee";
$route['app/employee/designation']="EmployeeController/designationHome";
$route['app/employee/designation/save']="EmployeeController/saveDesignation";
$route['app/delete/designation']="EmployeeController/deleteDesignation";
$route['app/employee/designation/edit']="EmployeeController/editDesignation";
$route['app/employee/designation/update']="EmployeeController/updateDesignation";
$route['app/employee/attendance']="EmployeeController/attendanceRegistration";
$route['app/employee/attendance/registration']="EmployeeController/getAttendanceRegistration";
$route['app/employee/salary/scheme']="EmployeeController/salaryScheme";
$route['app/salary/allowance/save']="SalaryController/saveAllowance";
$route['app/salary/allowances'] = "SalaryController/getAllowances";
$route['app/allowance/name']="SalaryController/getAllowanceName";
$route['app/salary/scheme/save']="SalaryController/saveSalaryScheme";
$route['app/salary/scheme/provide']="SalaryController/provideSalaryScheme";
$route['app/delete/salary/scheme'] = "SalaryController/deleteSalaryScheme";
$route['app/edit/salary/scheme'] = "SalaryController/editSalaryScheme";
$route['app/update/salary/scheme'] = "SalaryController/updateSalaryScheme";
$route['app/add/employee/salary/scheme']="SalaryController/addSchemeToEmployee";
$route['app/employee/provide']="EmployeeController/provideEmployee";
$route['app/provide/single/employee']="EmployeeController/provideSingleEmployee";
$route['app/save/employee/salary/scheme']="EmployeeController/saveEmployeeSalaryScheme";
$route['app/provide/employee/salary/scheme']="EmployeeController/provideEmployeeSalaryScheme";
$route['app/delete/employee/salary/scheme']="EmployeeController/deleteEmployeeSalaryScheme";
$route['app/salary/generation']="SalaryController/salaryGeneration";
$route['app/provide/employee/month/salary/scheme']="SalaryController/provideMonthlySalaryScheme";
$route['app/provide/assigned/scheme/allowance']="SalaryController/provideAssignedSchemeAllowance";
$route['app/provide/assigned/scheme/deduction']="SalaryController/provideAssignedSchemeDeduction";
$route['app/provide/assigned/scheme/contribution']="SalaryController/provideAssignedSchemeContribution";
$route['app/provide/employee/salary/slip']="SalaryController/provideEmployeeSalarySlip";
$route['app/save/employee/salary']="SalaryController/saveSalary";
$route['app/delete/employee/salary'] = "SalaryController/deleteSalary";
$route['app/salary/slip/payment']="SalaryController/salaryPayment";
$route['app/salary/slip/print'] = "SalaryController/printSalarySlip";
$route['app/filter/salary/slip'] = "SalaryController/provideSalarySlip";
$route['app/slip/print/(:num)'] = "PrintController/printSlip/$1";
$route['app/filter/employee/salary']="SalaryController/filterEmployeeSalary";
$route['app/make/employee/salary/payment']="SalaryController/makePayment";
$route['app/employee/daily/attendance'] = "AttendanceController";
$route['app/save/employee/daily/attendance']="AttendanceController/saveEmployeeAttendance";
$route['app/filter/department/employee']= "AttendanceController/filterDeptEmployee";
$route['app/fill/employee/attendance'] = "AttendanceController/showAttendanceSheet";
$route['app/fill/department/employee/attendance'] = "AttendanceController/fillAttendance";
$route['app/save/employee/fill/attendance'] = "AttendanceController/saveFillAttendance";
$route['app/assign/leave'] = "LeaveController";
$route['app/save/assign/leave'] = "LeaveController/saveAssignLeave";
$route['api/provide/assigned/leave'] = "LeaveController/provideAssignedLeave";
$route['app/search/assigned/leave'] = "LeaveController/filterAssignedLeave";
$route['app/delete/assigned/leave'] = "LeaveController/deleteAssignedLeave";
$route['app/assign/employee/leave'] = "LeaveController/assignEmployeeLeave";
$route['app/provide/employee/leaves']= "LeaveController/provideEmployeeLeaves";
$route['app/save/employee/leaves'] = "LeaveController/saveEmployeeLeaves";
$route['app/leave/application'] = "LeaveController/leaveApplication";
$route['app/provide/assigned/employee/leave'] = "LeaveController/provideEmpAssignedLeave";
$route['app/provide/single/leave/type'] = "LeaveController/provideSingleLeaveType";
$route['app/provide/leave/count']="LeaveController/countLeave";
$route['app/save/employee/leave/taken'] = "LeaveController/saveLeaveTaken";
$route['app/advance/payment'] = "SalaryAdvanceController";
$route['app/save/employee/salary/advance'] = "SalaryAdvanceController/saveAdvanceSalary";
$route['app/delete/salary/advance'] = "SalaryAdvanceController/deleteAdvanceSalary";
$route['provide/advance/taken'] = "SalaryAdvanceController/provideAdvanceTaken";
$route['app/employee/security/deposit'] = "SecurityDepositController";
$route['app/save/employee/security'] = "SecurityDepositController/saveSecurityAmount";
$route['app/provide/employee/security/deposits']="SecurityDepositController/provideSecurityDeposits";
$route['app/delete/security/deposit'] = "SecurityDepositController/deleteSecurityDeposit";
$route['app/provide/employee/salary/advance'] = "SalaryAdvanceController/provideSalaryAdvance";
$route['provide/employee/absent/days'] = "AttendanceController/provideAbsent";
$route['api/app/provide/bank/ledger'] = "MasterController/provideBank";


//Accounting route
$route['app/account/voucher/entry']="VoucherController";
$route['app/account/contra/ledger'] = "VoucherController/provideContraLedger";
$route['app/post/account/ledger'] = "VoucherController/postVoucher";
$route['app/account/day/book'] = "VoucherController/provideDayBook";
$route['app/provide/day/book/vouchers']="VoucherController/provideFilteredVouchers";
$route['app/provide/account/payment/debit/ledger']="VoucherController/provideDebitPaymentLedger";
$route['app/provide/account/payment/credit/ledger']="VoucherController/provideCreditPaymentLedger";
$route['app/provide/account/receipt/debit/ledger']="VoucherController/provideDebitReceiptLedger";
$route['app/provide/account/receipt/credit/ledger']="VoucherController/provideCreditReceiptLedger";
$route['app/provide/account/journal/ledger']="VoucherController/supplyJournalLedger";
$route['app/account/trial/balance']="AccountController/showTrialBalance";
$route['app/provide/account/trial/balance']="AccountController/provideTrialBalance";
$route['app/account/cash/bank/book']= "AccountController/showCashBankBook";
$route['app/account/provide/cash/in/hand'] = "AccountController/provideCashInHand";
$route['app/provide/account/cash/bank']="AccountController/provideCashAndBankBook";
$route['app/account/delete/voucher'] = "AccountController/showLedgerVouchers";
$route['app/filter/ledger/vouchers'] = "AccountController/provideLedgerVouchers";
$route['app/delete/ledger/voucher'] = "AccountController/deleteLedgerVoucher";
$route['app/account/profit/loss'] = "AccountController/showProfitAndLoss";
$route['api/provide/account/profit/loss'] = "AccountController/calculateProfitAndLoss";
$route['app/account/balance/sheet'] = "AccountController/showBalanceSheet";
$route['api/provide/account/balance/sheet'] = "AccountController/provideBalanceSheet";

//download and upload
$route['app/download/sample/excel'] = "DownloadController/downloadSampleExcel";
$route['app/upload/sample/excel'] = "UploadController/uploadEmployeeExcel";