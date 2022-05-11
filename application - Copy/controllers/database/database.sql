

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `IsDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `aauth_groups` (`id`, `name`, `definition`, `IsActive`, `IsDeleted`) VALUES
(1, 'Admin', 'Super Admin Group', 1, 0),
(2, 'Public', 'Public Access Group', 1, 0),
(3, 'Default', 'Default Access Group', 1, 0),
(4, 'Operator', 'Operator Access Group', 1, 0),
(5, 'Pathologist', 'Pathologist Group', 1, 0),
(6, 'Receptionist', 'Receptionist Group', 1, 0),
(7, 'Supervisor', 'Supervisor Group', 1, 0),
(8, 'Accountant', 'Accountant Group', 1, 0),
(9, 'Sales', 'Sales Group', 1, 0);



CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(1, '::1', '2020-03-25 06:51:16', 1),
(2, '::1', '2020-03-25 06:56:53', 5),
(10, '::1', '2020-03-25 12:00:25', 3),
(11, '::1', '2020-03-25 12:07:39', 1),
(13, '::1', '2020-03-25 12:23:20', 1),
(14, '::1', '2020-03-25 12:33:40', 5),
(67, '::1', '2020-10-15 05:48:14', 2);



CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `IsDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `aauth_perms` (`id`, `name`, `definition`, `IsActive`, `IsDeleted`) VALUES
(1, 'View', 'View control access', 1, 0),
(2, 'Edit', 'Edit control access', 1, 0),
(3, 'Delete', 'Delete control access', 1, 0),
(4, 'Update', 'Update control access', 1, 0),
(5, 'Print Report', 'Print report control', 1, 0),
(6, 'Create Receipt', 'Create Receipt controller', 1, 0),
(7, 'Allow Access', 'allow to see a page', 1, 0),
(8, 'Print Invoice', 'Printing any bill', 1, 0),
(9, 'Unlink', 'Unlink', 1, 0),
(10, 'Generate Salary', 'Generate Salary', 1, 0),
(11, 'Make Payment', 'Make Payment', 1, 0),
(12, 'MakePayment', 'MakePayment', 1, 0),
(13, 'PrintPaySlip', 'PrintPaySlip', 1, 0),
(14, 'PrintReport', 'Print Report', 1, 0),
(15, 'Remove', 'Remove', 1, 0),
(16, 'DeleteReport', 'DeleteReport', 1, 0);



CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `aauth_perm_to_user` (`perm_id`, `user_id`) VALUES
(1, 3),
(1, 4),
(1, 10),
(2, 3),
(2, 4),
(2, 10),
(4, 4),
(4, 10),
(5, 3),
(5, 4),
(5, 10),
(6, 3),
(6, 4),
(6, 10),
(7, 3),
(7, 4),
(7, 10),
(8, 3),
(8, 10),
(12, 10),
(13, 3),
(13, 10),
(14, 3),
(14, 10),
(15, 3);



CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `IsDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `IsActive`, `IsDeleted`) VALUES
(1, 'admin123@gmail.com', '70bb30fffe0fb78b251997cbee7166f7c78bfdf8dd1ef0065839569e7265647b', 'SuperAdmin', 0, '2020-10-15 17:46:13', '2020-10-15 17:46:13', NULL, NULL, NULL, NULL, NULL, NULL, '::1', 1, 0),
(3, 'receiptionist@gmail.com', '4b1fbcf811f49742fac555ff6ecb931ebf35a396cc933877acbd13fe369f1793', 'Receiptionist', 0, '2020-10-15 16:11:38', '2020-10-15 16:11:38', '2020-03-27 08:11:08', NULL, NULL, NULL, NULL, NULL, '::1', 1, 0),
(4, 'marcopolo@gmail.com', '9e0db257262003bf1a269878a0da0124623b40530f21bc64d4c6da373c407d69', 'Pathologist', 0, NULL, NULL, '2020-03-27 16:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(5, 'jonson@gmail.com', '28a9d1ac311fc87b88b094cd50b05abf517134b03d636bbc7ee94401f9952a21', '', 0, NULL, NULL, '2020-03-28 12:08:11', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(6, 'anthoney@gmail.com', '3913228818759cd846b475d3106a4ecc9bf9bd91746cab4e88a8750c11d15914', '', 0, NULL, NULL, '2020-03-28 12:11:58', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(7, 'sean@gmail.com', '3e1340c771fff1153aa60137dc8c0265d5914e5de769b59183085b78d950b31b', '', 0, NULL, NULL, '2020-03-28 12:14:53', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(8, 'salesman@gmail.com', '8e7d10c7c802e6cc70ddc57bcb1477eb8f3083b0f088f9427e4d56600b065bbe', '', 0, NULL, NULL, '2020-10-03 19:38:13', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(10, 'pathologist@gmail.com', '06f3b03c31a6c3851d7b0bec7fc046134890f3892708158ccceea0a8f08fb9a4', 'PathologistA', 0, '2020-10-15 16:11:25', '2020-10-15 16:11:25', '2020-10-15 16:09:35', NULL, NULL, NULL, NULL, NULL, '::1', 1, 0);



CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3),
(3, 3),
(3, 6),
(4, 3),
(4, 5),
(5, 3),
(5, 8),
(6, 3),
(7, 3),
(8, 3),
(10, 3),
(10, 5);



CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `acc_transaction` (
  `ID` int(11) NOT NULL,
  `LedgerID` bigint(11) NOT NULL,
  `VNo` bigint(50) DEFAULT NULL,
  `Vtype` varchar(21) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `Narration` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `IsPosted` int(1) DEFAULT NULL,
  `CreatedBy` bigint(11) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedAt` date DEFAULT NULL,
  `IsAppoved` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





CREATE TABLE `advancesalary` (
  `ID` bigint(11) NOT NULL,
  `AdvanceDate` date NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `AdvanceAmount` decimal(11,2) NOT NULL,
  `Remark` varchar(31) NOT NULL,
  `PayType` int(1) NOT NULL,
  `PaymentMode` int(2) NOT NULL,
  `Bank` int(2) NOT NULL,
  `RefNo` varchar(51) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `assignedleave` (
  `ID` bigint(11) NOT NULL,
  `DesignationID` bigint(11) NOT NULL,
  `LeaveTypeID` bigint(11) NOT NULL,
  `LeaveNo` int(3) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `bloodgroup` (
  `ID` bigint(11) NOT NULL,
  `BloodGroup` varchar(11) NOT NULL,
  `Description` varchar(31) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `bloodgroup` (`ID`, `BloodGroup`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'A+', 'A+', '2020-10-06', '2020-10-06'),
(2, 'A', 'A', '2020-10-06', '2020-10-06'),
(7, 'Test', 'Test', '2020-10-06', '2020-10-06'),
(8, 'B', 'B', '2020-10-06', '2020-10-06'),
(9, 'B+', 'B+', '2020-10-06', '2020-10-06'),
(10, 'AB+', 'AB+', '2020-10-06', '2020-10-06'),
(11, 'A-', 'A-', '2020-10-06', '2020-10-06'),
(12, 'O+', 'O+', '2020-10-06', '2020-10-06'),
(13, 'O-', 'O-', '2020-10-06', '2020-10-06'),
(14, 'B-', 'B-', '2020-10-06', '2020-10-06'),
(15, 'AA+', 'Test Blood', '2020-10-15', '2020-10-15');



CREATE TABLE `category` (
  `ID` bigint(11) NOT NULL,
  `Category` varchar(91) NOT NULL,
  `ShortName` varchar(51) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `IsDeleted` int(1) NOT NULL,
  `CreatedBy` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `category` (`ID`, `Category`, `ShortName`, `IsActive`, `IsDeleted`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'BIOCHEMISTRY', 'BIOCHEM', 1, 0, 1, '2019-07-23', '2020-08-18'),
(2, 'HAEMATOLOGY', 'HMTLGY', 1, 0, 1, '2019-07-29', '2020-03-06'),
(3, 'SEROLOGY', 'SRLGY', 1, 0, 1, '2019-08-24', '2020-02-22'),
(4, 'MICROBIOLOGY', 'MCB', 1, 0, 1, '2019-08-24', '2020-02-22'),
(5, 'HISTOPATHOLOGY', 'HISTP', 1, 0, 1, '2019-08-24', '2020-04-05'),
(6, 'IMMUNOLOGY', 'IMMLG', 1, 0, 1, '2019-08-24', '2020-02-22'),
(7, 'COMPLETE BLOOD COUNT', 'CBC', 1, 0, 1, '2019-08-24', '2020-03-10'),
(8, 'ABSOLUTE EOSINOPHIL COUNT', 'EOSINOPHIL', 1, 0, 1, '2019-08-24', '2020-03-10'),
(9, 'MP QBC', 'QBC', 1, 0, 1, '2019-08-24', '2020-03-10'),
(10, 'URINE ROUTINE', 'URIN', 1, 0, 1, '2019-08-24', '2020-03-10'),
(31, 'testeeetrtr', 'test', 1, 1, 1, '2019-08-24', '2019-08-24'),
(56, 'TEST CATEGORY', 'TEST PURPOSE', 1, 0, 1, '2020-10-06', '2020-10-06');



CREATE TABLE `department` (
  `ID` bigint(11) NOT NULL,
  `Department` varchar(91) NOT NULL,
  `Description` varchar(91) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `department` (`ID`, `Department`, `Description`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'ANDROSCOPY', 'ANDROSCOPY', 1, '2020-04-27', '2020-05-10'),
(2, 'CHEST', 'chest department', 1, '2020-04-27', '2020-10-06'),
(3, 'PULMONARY', 'pulmonary', 1, '2020-04-27', '2020-04-27'),
(5, 'GYNAECOLOGY', 'Gynaecology', 1, '2020-04-27', '2020-04-29'),
(6, 'MEDECINE', 'medicine', 1, '2020-04-27', '2020-08-18'),
(9, 'DYLISIS', 'DYLYSIS', 1, '2020-05-01', '2020-05-01'),
(10, 'PATHOLOGY', 'Pathology', 1, '2020-06-16', '2020-10-06'),
(13, 'XRAY', 'XRAY', 1, '2020-10-11', '2020-10-11'),
(14, 'ADMINISTRATION', 'Administration', 1, '2020-10-12', '2020-10-12');



CREATE TABLE `designation` (
  `ID` bigint(11) NOT NULL,
  `Designation` varchar(51) NOT NULL,
  `Description` varchar(51) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `designation` (`ID`, `Designation`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'PATHOLOGIST', 'PATHOLOGIST', '2020-06-23', '2020-06-23'),
(2, 'RECEIPTIONIST', 'RECEIPTIONIST', '2020-06-23', '2020-06-23'),
(3, 'Accountant', 'ACCOUNTANT', '2020-06-30', '2020-06-30'),
(4, 'MANAGER', 'MANAGER', '2020-06-30', '2020-06-30'),
(5, 'DOCTOR', 'DOCTOR', '2020-06-30', '2020-06-30'),
(6, 'MARKETING MANAGER', 'MARKETING MANAGER', '2020-06-30', '2020-06-30'),
(7, 'TEST', 'TEST', '2020-10-10', '2020-10-10'),
(8, 'Admin', 'Admin', '2020-10-12', '2020-10-12'),
(9, 'Super Admin', 'SUPER ADMIN', '2020-10-12', '2020-10-12');



CREATE TABLE `doctor` (
  `ID` bigint(11) NOT NULL,
  `Salutation` varchar(11) NOT NULL,
  `FirstName` varchar(31) NOT NULL,
  `LastName` varchar(31) NOT NULL,
  `MobileNo` bigint(11) NOT NULL,
  `Email` varchar(51) NOT NULL,
  `Designation` varchar(51) NOT NULL,
  `DepartmentID` bigint(11) NOT NULL,
  `Specialist` varchar(51) NOT NULL,
  `Qualification` varchar(31) NOT NULL,
  `Address` varchar(91) NOT NULL,
  `Hospital` varchar(91) NOT NULL,
  `Commision` int(11) NOT NULL DEFAULT 0,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `doctorcommision` (
  `ID` bigint(11) NOT NULL,
  `ReceiptNo` bigint(111) NOT NULL,
  `PatientID` bigint(11) NOT NULL,
  `PatientName` varchar(91) NOT NULL,
  `DoctorID` bigint(11) NOT NULL,
  `NetAmount` decimal(11,2) NOT NULL,
  `CommisionAmount` decimal(11,2) NOT NULL,
  `PayAmount` decimal(11,2) NOT NULL,
  `IsPaid` int(1) NOT NULL DEFAULT 0,
  `IsDeleted` int(1) NOT NULL DEFAULT 0,
  `UpdatedBy` int(1) NOT NULL DEFAULT 0,
  `DeletedBy` int(1) NOT NULL DEFAULT 0,
  `PaymentDate` date NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `empattendanceregistration` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `AttendanceID` varchar(11) NOT NULL,
  `LeaveTaken` bigint(11) NOT NULL,
  `TotalAbsent` int(11) NOT NULL,
  `WorkingDays` int(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `employee` (
  `ID` bigint(11) NOT NULL,
  `ResumeNo` varchar(11) NOT NULL,
  `EmployeeCode` varchar(31) NOT NULL,
  `Salutation` varchar(11) NOT NULL,
  `FirstName` varchar(31) NOT NULL,
  `LastName` varchar(31) NOT NULL,
  `ShortName` varchar(21) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `FatherName` varchar(31) NOT NULL,
  `MotherName` varchar(31) NOT NULL,
  `JobType` int(1) NOT NULL,
  `DepartmentID` bigint(11) NOT NULL,
  `DesignationID` bigint(11) NOT NULL,
  `EmployeeType` int(1) NOT NULL,
  `JoiningDate` date NOT NULL,
  `Gender` int(1) NOT NULL,
  `MaritalStatus` int(1) NOT NULL,
  `BankAccountNo` varchar(51) NOT NULL,
  `BankName` varchar(51) NOT NULL,
  `ESINo` varchar(51) NOT NULL,
  `PFNo` varchar(51) NOT NULL,
  `PANNo` varchar(31) NOT NULL,
  `Nationality` int(11) NOT NULL,
  `BloodGroupID` bigint(11) NOT NULL,
  `CurrentEmployee` int(1) NOT NULL,
  `Address` varchar(91) NOT NULL,
  `StateOrProvince` varchar(31) NOT NULL,
  `City` varchar(31) NOT NULL,
  `PinOrZip` varchar(31) NOT NULL,
  `PhoneNumber` bigint(15) NOT NULL,
  `Email` varchar(51) NOT NULL,
  `PrevClinicName` varchar(51) NOT NULL,
  `JobNature` int(1) NOT NULL,
  `PrevClinicAddress` varchar(91) NOT NULL,
  `PrevPhoneNo` bigint(15) NOT NULL,
  `FromYear` date NOT NULL,
  `ToYear` date NOT NULL,
  `Experience` int(11) NOT NULL,
  `Salary` decimal(11,2) NOT NULL,
  `PrevDepartment` bigint(11) NOT NULL,
  `PreDesignation` bigint(11) NOT NULL,
  `JobProfile` varchar(31) NOT NULL,
  `HighestQualification` varchar(31) NOT NULL,
  `University` varchar(31) NOT NULL,
  `YearOfPassing` bigint(4) NOT NULL,
  `GradeOrPercentage` varchar(11) NOT NULL,
  `Subject` varchar(91) NOT NULL,
  `Specialization` varchar(91) NOT NULL,
  `Remarks` varchar(91) NOT NULL,
  `UserID` bigint(11) NOT NULL,
  `ProfileUrl` text NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `employeeadvance` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `AdvanceReceived` double(11,2) NOT NULL,
  `AdvancePaid` double(11,2) NOT NULL,
  `AdvanceBalance` double(11,2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `employeeallowance` (
  `ID` bigint(11) NOT NULL,
  `AllowanceType` char(1) NOT NULL,
  `Name` varchar(31) NOT NULL,
  `Code` varchar(31) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `employeeallowance` (`ID`, `AllowanceType`, `Name`, `Code`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'A', 'DA', 'DA', '2020-06-26', '2020-06-26'),
(2, 'A', 'TA', 'TA', '2020-06-26', '2020-06-26'),
(3, 'A', 'HR', 'HR', '2020-06-26', '2020-06-26'),
(4, 'D', 'PF', 'PF', '2020-06-27', '2020-06-27'),
(5, 'C', 'PF', 'PF', '2020-06-27', '2020-06-27'),
(6, 'A', 'HRA', 'HRA', '2020-07-08', '2020-07-08'),
(7, 'A', 'FBP', 'FBP', '2020-07-09', '2020-07-09'),
(8, 'A', 'BONUS', 'BONUS', '2020-07-09', '2020-07-09'),
(9, 'D', 'IT', 'Income Tax', '2020-07-09', '2020-07-09'),
(10, 'C', 'INSURANCE', 'INSURANCE', '2020-07-09', '2020-07-09'),
(11, 'C', 'MI', 'Medical Insurance', '2020-07-09', '2020-07-09'),
(12, 'A', 'EA', 'Entertainment', '2020-07-09', '2020-07-09');



CREATE TABLE `employeeassignleave` (
  `EmployeeID` bigint(11) NOT NULL,
  `LeaveTypeID` int(11) NOT NULL,
  `NoOfLeave` int(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `employeeattendance` (
  `EmployeeID` bigint(11) NOT NULL,
  `DepartmentID` bigint(11) NOT NULL,
  `AttendanceDate` date NOT NULL,
  `Status` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `employeeleave` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `TotalLeaveAssigned` int(3) NOT NULL,
  `LeaveTaken` decimal(3,1) NOT NULL DEFAULT 0.0,
  `LeaveBalance` decimal(3,1) NOT NULL DEFAULT 0.0,
  `TotalPresent` decimal(3,1) NOT NULL DEFAULT 0.0,
  `TotalAbsent` decimal(3,1) NOT NULL DEFAULT 0.0,
  `CreatedAt` date NOT NULL,
  `UpdateAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `employeeleavemanager` (
  `EmployeeID` bigint(11) NOT NULL,
  `ApplicationDate` date NOT NULL,
  `ApplicationFor` int(1) NOT NULL,
  `LeaveFor` int(1) NOT NULL,
  `LeaveFrom` date NOT NULL,
  `LeaveTo` date NOT NULL,
  `LeaveTypeID` bigint(11) NOT NULL,
  `Status` varchar(11) NOT NULL,
  `DayCount` int(3) NOT NULL,
  `Remarks` varchar(50) NOT NULL,
  `IsSunday` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `employeesalaryscheme` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `SalarySchemeID` bigint(11) NOT NULL,
  `BasicSalary` decimal(11,2) NOT NULL,
  `SalaryMonth` date NOT NULL,
  `CreatedAt` int(11) NOT NULL,
  `UpdatedAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `employeesecurity` (
  `ID` bigint(11) NOT NULL,
  `SecurityAmount` double(11,2) NOT NULL,
  `AmountDeposited` double(11,2) NOT NULL,
  `AmountDue` double(11,2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `globalsettings` (
  `ID` bigint(11) NOT NULL,
  `SalarySlipType` int(1) NOT NULL,
  `SalarySlipText` varchar(31) NOT NULL,
  `SalarySlipCurrentYear` bigint(4) NOT NULL,
  `SalarySlipStartingNum` bigint(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `item` (
  `ID` bigint(11) NOT NULL,
  `ItemTypeID` bigint(11) NOT NULL,
  `ItemName` varchar(51) NOT NULL,
  `Description` varchar(51) NOT NULL,
  `OpeningBalance` int(11) NOT NULL,
  `Rate` decimal(11,2) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `itemtype` (
  `ID` bigint(11) NOT NULL,
  `ItemType` varchar(91) NOT NULL,
  `Description` varchar(91) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `itemtype` (`ID`, `ItemType`, `Description`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'LAB INCUBATOR', 'LAB INCUBATOR', 1, '2020-05-27', '2020-10-09'),
(2, 'LABORATORY STIRRER', 'LABORATORY STIRRER', 1, '2020-05-27', '2020-05-27'),
(3, 'CENTRIFUGE TUBE', 'CENTRIFUGE TUBE', 1, '2020-05-27', '2020-05-27'),
(4, 'NEEDLE DESTROYERS', 'NEEDLE DESTROYERS', 1, '2020-05-27', '2020-05-27'),
(5, 'ELECTRONIC BALANCE', 'ELECTRONIC BALANCE', 1, '2020-05-27', '2020-05-27'),
(6, 'REFRIGERATED CENTRIFUGE', 'REFRIGERATED CENTRIFUGE', 1, '2020-05-27', '2020-05-27'),
(7, 'BLOOD BANK EQUIPMENTS', 'BLOOD BANK EQUIPMENTS', 1, '2020-05-27', '2020-05-27'),
(8, 'MICROCENTRIFUGE TUBE', 'MICROCENTRIFUGE TUBE', 1, '2020-05-27', '2020-05-27'),
(9, 'CHEMICAL ANALYSIS EQUIPMENT', 'CHEMICAL ANALYSIS EQUIPMENT', 1, '2020-05-27', '2020-05-27'),
(10, 'MICROCENTRIFUGE TUBE', 'MICROCENTRIFUGE TUBE', 1, '2020-05-27', '2020-05-27'),
(12, 'TESTITEM', 'TESTITEM', 1, '2020-10-09', '2020-10-09');



CREATE TABLE `leavetype` (
  `ID` bigint(11) NOT NULL,
  `LeaveType` varchar(51) NOT NULL,
  `Status` varchar(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `leavetype` (`ID`, `LeaveType`, `Status`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'CASUAL LEAVE', 'PAID', '2020-07-01', '2020-07-01'),
(2, 'EMERGENCY LEAVE', 'PAID', '2020-07-22', '2020-07-22'),
(3, 'SICK LEAVE', 'PAID', '2020-07-23', '2020-07-23'),
(4, 'Maternity leave', 'PAID', '2020-07-23', '2020-07-23'),
(5, 'UNPAID LEAVE', 'NOT PAID', '2020-07-01', '2020-07-02');



CREATE TABLE `ledger` (
  `ID` bigint(11) NOT NULL,
  `Ledger` varchar(91) NOT NULL,
  `LedgerAlias` varchar(91) NOT NULL,
  `CompanyID` bigint(11) NOT NULL,
  `LedgerGroupID` bigint(11) NOT NULL,
  `Remarks` varchar(51) NOT NULL,
  `TB` int(1) NOT NULL,
  `PL` int(1) NOT NULL,
  `BS` int(1) NOT NULL,
  `IsContraEntry` int(1) NOT NULL,
  `IsPaymentEntry` int(1) NOT NULL,
  `IsReceiptEntry` int(1) NOT NULL,
  `IsCashBankBook` int(1) NOT NULL,
  `IsCash` int(1) NOT NULL,
  `IsExpense` int(1) NOT NULL,
  `IsIncome` int(1) NOT NULL,
  `IsBalanceSheet` int(1) NOT NULL,
  `IsDoctorCommission` int(1) NOT NULL,
  `IsSalary` int(1) NOT NULL,
  `IsSalaryPayable` int(1) NOT NULL,
  `IsSalaryAdvance` int(1) NOT NULL,
  `IsBank` int(1) NOT NULL,
  `IsSecurityDeposit` int(1) NOT NULL,
  `IsTestFee` int(1) NOT NULL,
  `OpeningBalance` decimal(11,2) NOT NULL,
  `BalanceType` varchar(2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `ledger` (`ID`, `Ledger`, `LedgerAlias`, `CompanyID`, `LedgerGroupID`, `Remarks`, `TB`, `PL`, `BS`, `IsContraEntry`, `IsPaymentEntry`, `IsReceiptEntry`, `IsCashBankBook`, `IsCash`, `IsExpense`, `IsIncome`, `IsBalanceSheet`, `IsDoctorCommission`, `IsSalary`, `IsSalaryPayable`, `IsSalaryAdvance`, `IsBank`, `IsSecurityDeposit`, `IsTestFee`, `OpeningBalance`, `BalanceType`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'SALARY PAYABLE A/C', 'SALARY PAYABLE A/C', 1, 7, 'NA', 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(2, 'SALARY A/C', 'SALARY A/C', 1, 11, 'NA', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(3, 'PF', 'PF', 1, 7, 'NA', 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(4, 'PNB', 'PNB', 1, 1, 'NA', 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(5, 'UCO BANK', 'UCO BANK', 1, 1, 'NA', 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(6, 'QBAX ASSOCIATES', 'QBAX ASSOCIATES', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(7, 'SETMAX PVT LTD', 'SETMAX PVT LTD', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-28', '2020-05-28'),
(8, 'BIO - X', 'BIO - X', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-29', '2020-05-29'),
(9, 'RMD MEDIAIDS LIMITED', 'RMD MEDIAIDS LIMITED', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-29', '2020-05-29'),
(10, 'SAFIRE SCIENTIFIC COMPANY', 'SAFIRE SCIENTIFIC COMPANY', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-29', '2020-05-29'),
(11, 'ELECTRONEX', 'ELECTRONEX', 1, 25, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-05-29', '2020-05-29'),
(12, 'CASH', 'CASH', 1, 5, 'CASH', 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-09', '2020-08-09'),
(13, 'SBI BANK A/C', 'BANK', 1, 1, 'BANK', 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '0.00', '', '2020-08-09', '2020-08-09'),
(14, 'CONVEYANCE FEE', 'CONVEYANCE FEE', 1, 13, 'FEE HEAD', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(15, 'SAPNA STATIONERS', 'SAPNA STATIONERS', 1, 25, 'VENDOR', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(16, 'CAPITAL A/C', 'CAPITAL A/C', 1, 4, 'CAPITAL A/C', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(17, 'TAX A/C', 'TAX A/C', 1, 9, 'NA', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(18, 'PURCHASE A/C', 'PURCHASE A/C', 1, 20, 'NA', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(19, 'TEST FEE A/C', 'TEST FEE A/C', 1, 13, 'NA', 2, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, '0.00', '', '2020-08-12', '2020-08-12'),
(20, 'MACHINARY A/C', 'MACHINARY A/C', 1, 6, '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(21, 'DOCTOR COMMISION A/C', 'DOCTOR COMMISION A/C', 1, 10, 'NA', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-12', '2020-08-12'),
(22, 'POWER AND ELECTRICITY', 'POWER AND ELECTRICITY', 1, 10, 'EXPENSE', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-10-09'),
(23, 'CHEMICALS A/C', 'CHEMICALS A/C', 1, 10, 'EXPENSE', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(24, 'SALES A/C', 'SALES A/C', 1, 13, 'INCOME', 2, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(25, 'PURCHASE RETURN A/C', 'PURCHASE RETURN A/C', 1, 20, 'PURCHASE', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(26, 'SALES RETURN A/C', 'SALES RETURN A/C', 1, 24, 'STOCK IN HAND', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(27, 'DRAWINGS A/C', 'DRAWINGS A/C', 1, 7, 'LIABILITIES', 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(28, 'WAGES A/C', 'WAGES A/C', 1, 11, 'EXPENSE', 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-14', '2020-08-14'),
(29, 'FURNITURE A/C', 'FURNITURE A/C', 1, 12, 'ASSETS', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '', '2020-08-15', '2020-08-15'),
(30, 'SALARY ADVANCE A/C', 'SALARY ADVANCE A/C', 1, 16, 'SALARY ADVANCE ACCOUNT', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, '0.00', '', '2020-10-01', '2020-10-01'),
(33, 'SECURITY DEPOSIT A/C', 'Security Deposit A/C', 1, 7, 'Security', 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '0.00', '', '2020-10-12', '2020-10-12');



CREATE TABLE `ledgergroup` (
  `ID` bigint(11) NOT NULL,
  `LedgerGroup` varchar(91) NOT NULL,
  `UnderGroupID` bigint(11) NOT NULL,
  `TrialBalance` int(1) NOT NULL,
  `ProfitLoss` int(1) NOT NULL,
  `BalanceSheet` int(1) NOT NULL,
  `Remarks` varchar(91) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `ledgergroup` (`ID`, `LedgerGroup`, `UnderGroupID`, `TrialBalance`, `ProfitLoss`, `BalanceSheet`, `Remarks`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'BANK ACCOUNTS', 6, 1, 0, 0, 'NA', '2020-05-22', '2020-05-22'),
(2, 'BANK OCC A/C', 17, 2, 0, 2, 'NA', '2020-05-22', '2020-05-22'),
(3, 'BANK OD A/C', 17, 2, 0, 2, 'NA', '2020-05-22', '2020-05-22'),
(4, 'CAPITAL A/C', 4, 2, 0, 2, 'NA', '2020-05-22', '2020-05-22'),
(5, 'CASH IN HAND', 6, 1, 0, 1, 'NA', '2020-05-22', '2020-05-22'),
(6, 'CURRENT ASSETS', 6, 1, 0, 1, 'NA', '2020-05-22', '2020-05-22'),
(7, 'CURRENT LIABILITIES', 7, 1, 0, 2, 'NA', '2020-05-22', '2020-05-22'),
(8, 'DEPOSITS ASSETS', 6, 2, 0, 1, 'NA', '2020-05-22', '2020-05-22'),
(9, 'DUTIES & TAXES', 7, 2, 0, 2, 'NA', '2020-05-22', '2020-05-22'),
(10, 'EXPENSES (DIRECT)', 10, 1, 1, 0, 'NA', '2020-05-22', '2020-05-22'),
(11, 'EXPENSES (INDIRECT)', 11, 1, 1, 0, 'NA', '2020-05-26', '2020-05-26'),
(12, 'FIXED ASSETS', 12, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(13, 'INCOME (DIRECT)', 13, 2, 2, 0, 'NA', '2020-05-26', '2020-05-26'),
(14, 'INCOME (INDIRECT)', 14, 2, 2, 0, 'NA', '2020-05-26', '2020-05-26'),
(15, 'INVESTMENTS', 15, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(16, 'LOANS & ADVANCES (ASSET)', 6, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(17, 'LOANS LIABILITY', 17, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(18, 'MISC EXPENCES (ASSETS)', 18, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(19, 'PROVISIONS', 7, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(20, 'PURCHASE ACCOUNTS', 20, 1, 1, 0, 'NA', '2020-05-26', '2020-05-26'),
(21, 'RESERVES & SURPLUS', 4, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(22, 'RETAINED EARNINGS', 21, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(23, 'SECURED LOANS', 17, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(24, 'STOCK IN HAND', 24, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(25, 'SUNDRY CREDITORS', 7, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26'),
(26, 'SUNDRY DEBTORS', 6, 1, 0, 1, 'NA', '2020-05-26', '2020-05-26'),
(27, 'UNSECURED LOANS', 28, 2, 0, 2, 'NA', '2020-05-26', '2020-05-26');



CREATE TABLE `nationality` (
  `ID` bigint(11) NOT NULL,
  `Nationality` varchar(31) NOT NULL,
  `ShortName` varchar(31) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `nationality` (`ID`, `Nationality`, `ShortName`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(2, 'USA', 'USA', 1, '2020-10-13', '2020-10-13'),
(3, 'INDIAN', 'IND', 1, '2020-10-13', '2020-10-13'),
(4, 'AUSTRALIAN', 'AUS', 1, '2020-10-13', '2020-10-13'),
(5, 'ENGLAND', 'ENG', 1, '2020-10-13', '2020-10-13'),
(6, 'BRAZIL', 'BRZ', 1, '2020-10-13', '2020-10-13'),
(7, 'CHINA', 'CHIN', 1, '2020-10-13', '2020-10-13'),
(8, 'JAPANESE', 'JPN', 1, '2020-10-13', '2020-10-13'),
(11, 'TEST', 'TEST', 1, '2020-10-13', '2020-10-13');



CREATE TABLE `patient` (
  `ID` bigint(11) NOT NULL,
  `MRNo` varchar(91) NOT NULL,
  `FirstName` varchar(91) NOT NULL,
  `LastName` varchar(91) NOT NULL,
  `MobileNo` bigint(11) NOT NULL,
  `Email` varchar(31) NOT NULL,
  `BloodGroupID` bigint(11) NOT NULL,
  `Gender` int(1) NOT NULL COMMENT '1-Male,2-Female',
  `DateOfBirth` date NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(225) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `Image` text NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `paymentmode` (
  `ID` bigint(11) NOT NULL,
  `PaymentMode` varchar(11) NOT NULL,
  `Description` varchar(35) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `paymentmode` (`ID`, `PaymentMode`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'NEFT', 'A', '2020-07-01', '2020-07-01'),
(2, 'RTGS', 'B', '2020-07-01', '2020-07-02'),
(3, 'PAYTM', 'C', '2020-07-01', '2020-07-08'),
(4, 'CHEQUE', 'CHEQUE', '2020-10-07', '2020-10-07'),
(5, 'GPAY', 'Paytm', '2020-10-07', '2020-10-07'),
(6, 'UPI', 'UPI', '2020-10-07', '2020-10-07'),
(9, 'TEST', 'Test', '2020-10-07', '2020-10-07'),
(10, 'CASH', 'CASH', '2020-10-10', '2020-10-10');



CREATE TABLE `purchase` (
  `ID` bigint(11) NOT NULL,
  `VendorID` bigint(11) NOT NULL,
  `BillNo` varchar(31) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `BillAmount` decimal(11,2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `purchaseitems` (
  `ID` bigint(11) NOT NULL,
  `PurchaseID` bigint(11) NOT NULL,
  `ItemType` varchar(51) NOT NULL,
  `ItemName` varchar(51) NOT NULL,
  `ItemTypeID` bigint(11) NOT NULL,
  `ItemNameID` bigint(11) NOT NULL,
  `Description` varchar(51) NOT NULL,
  `Rate` decimal(11,2) NOT NULL,
  `Quantity` bigint(11) NOT NULL,
  `Total` decimal(11,2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `receipt` (
  `ID` bigint(11) NOT NULL,
  `ReceiptNo` bigint(51) NOT NULL,
  `ReceiptDate` date NOT NULL,
  `ReceiptTime` datetime NOT NULL,
  `PatientID` bigint(11) NOT NULL,
  `DoctorID` bigint(11) NOT NULL,
  `TotalAmount` decimal(11,2) NOT NULL,
  `Discount` decimal(11,2) NOT NULL,
  `NetAmount` decimal(11,2) NOT NULL,
  `PaidAmount` decimal(11,2) NOT NULL,
  `DueAmount` decimal(11,2) NOT NULL,
  `IsPaid` int(1) NOT NULL,
  `IsPartialPaid` int(1) NOT NULL,
  `IsPrinted` int(11) NOT NULL,
  `IsReportGenerated` int(1) NOT NULL DEFAULT 0,
  `ReportDate` date NOT NULL,
  `IsDeleted` int(1) NOT NULL DEFAULT 0,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `receipttests` (
  `ReceiptID` bigint(11) NOT NULL,
  `CategoryID` bigint(11) NOT NULL DEFAULT 0,
  `TestNo` bigint(11) NOT NULL,
  `TestDescription` varchar(191) NOT NULL,
  `Charges` decimal(11,0) NOT NULL,
  `IsReportMade` int(1) NOT NULL,
  `ReceiptNo` bigint(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `salary` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `SlipSerialNo` bigint(91) NOT NULL,
  `SlipNo` varchar(91) NOT NULL,
  `SalaryGeneratedDate` date NOT NULL,
  `SalaryMonth` date NOT NULL,
  `Attendance` bigint(11) NOT NULL,
  `BasicSalary` decimal(11,2) NOT NULL,
  `TotalAllowance` decimal(11,2) NOT NULL,
  `TotalDeduction` decimal(11,2) NOT NULL,
  `TotalContribution` decimal(11,2) NOT NULL,
  `AdvanceReceived` decimal(11,2) NOT NULL,
  `SecurityReceived` decimal(11,2) NOT NULL,
  `GrossSalary` decimal(11,2) NOT NULL,
  `NetSalary` decimal(11,2) NOT NULL,
  `IsGenerated` int(1) NOT NULL,
  `IsCancelled` int(1) NOT NULL DEFAULT 0,
  `IsPaid` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `salarypayment` (
  `ID` int(11) NOT NULL,
  `SalaryID` bigint(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `PaymentMode` int(1) NOT NULL,
  `LedgerID` int(11) NOT NULL,
  `ChequeNo` varchar(31) NOT NULL DEFAULT 'NA',
  `ChequeDate` date NOT NULL,
  `PaymentStatus` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `salaryscheme` (
  `ID` int(11) NOT NULL,
  `SchemeCode` varchar(31) NOT NULL,
  `SchemeName` varchar(31) NOT NULL,
  `AllowanceType` char(1) NOT NULL,
  `AllowanceNameID` bigint(20) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `salaryscheme` (`ID`, `SchemeCode`, `SchemeName`, `AllowanceType`, `AllowanceNameID`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'SchemeOne', 'SchemeOne', 'C', 11, '2020-06-29', '2020-10-01'),
(2, 'SchemeTwo', 'SchemeTwo', 'D', 4, '2020-06-29', '2020-06-29'),
(3, 'SchemeSecond', 'SchemeSecond', 'A', 2, '2020-06-30', '2020-06-30'),
(4, 'FLAT1500', 'FLAT1500', 'A', 3, '2020-07-08', '2020-07-08'),
(5, 'FLAT2000', 'FLAT2000', 'A', 6, '2020-07-08', '2020-07-08'),
(6, 'FLAT3000', 'FLAT3000', 'C', 5, '2020-07-08', '2020-07-08'),
(7, 'PMGRY', 'PMGRY', 'C', 5, '2020-07-08', '2020-07-08'),
(8, 'POWER', 'POWER', 'C', 11, '2020-07-09', '2020-07-09');



CREATE TABLE `salaryschemeallowances` (
  `SalarySchemeID` bigint(11) NOT NULL,
  `AllowanceID` bigint(11) NOT NULL,
  `AllowanceType` char(1) NOT NULL DEFAULT 'N',
  `AllowanceName` varchar(31) NOT NULL,
  `SchemeBasedOn` char(1) NOT NULL,
  `Amount` decimal(11,2) NOT NULL,
  `Formula` varchar(51) NOT NULL,
  `BS` varchar(2) NOT NULL DEFAULT 'BS',
  `Symbol` char(2) DEFAULT 'NA',
  `value` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `securityamountdue` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `AmountDeposited` double(11,2) NOT NULL,
  `AmountPaid` double(11,2) NOT NULL,
  `DueAmount` double(11,2) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `securitydeposit` (
  `ID` bigint(11) NOT NULL,
  `EmployeeID` bigint(11) NOT NULL,
  `SecurityDepositDate` date NOT NULL,
  `TotalAmount` decimal(11,2) NOT NULL,
  `AmountPaid` decimal(11,2) NOT NULL,
  `AmountDue` decimal(11,2) NOT NULL,
  `Remark` varchar(51) NOT NULL,
  `PayType` int(2) NOT NULL,
  `PaymentMode` int(2) NOT NULL,
  `Bank` int(2) NOT NULL,
  `RefNo` varchar(31) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `settings` (
  `ID` bigint(11) NOT NULL,
  `LabName` varchar(51) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `PhoneNo1` bigint(21) NOT NULL,
  `PhoneNo2` bigint(21) NOT NULL,
  `TagLine` varchar(91) NOT NULL,
  `Email` varchar(31) NOT NULL,
  `Website` varchar(31) NOT NULL,
  `RegdNo` varchar(31) NOT NULL,
  `LabNo` varchar(31) NOT NULL,
  `LogoUrl` text NOT NULL,
  `TechnicianName` varchar(51) NOT NULL,
  `TechnicianQualification` varchar(51) NOT NULL,
  `Currency` varchar(5) NOT NULL DEFAULT '$',
  `DateFormat` int(1) NOT NULL COMMENT '1-DD-MM-YYYY, 2-MM-DD-YYYY , 3- YYYY-MM-DD',
  `FooterNote1` varchar(91) NOT NULL,
  `FooterNote2` varchar(91) NOT NULL,
  `FooterNote3` varchar(91) NOT NULL,
  `IsPrintReportHeader` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `IsDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `settings` (`ID`, `LabName`, `Address`, `PhoneNo1`, `PhoneNo2`, `TagLine`, `Email`, `Website`, `RegdNo`, `LabNo`, `LogoUrl`, `TechnicianName`, `TechnicianQualification`, `Currency`, `DateFormat`, `FooterNote1`, `FooterNote2`, `FooterNote3`, `IsPrintReportHeader`, `CreatedAt`, `UpdatedAt`, `IsActive`, `IsDeleted`) VALUES
(1, 'MORDEN HEALTH CARE', 'Sambalpur,<br>Near Ganesh Market Complex<br>Budharaja-768212', 8956784585, 8956895685, 'AN ISO 9001 2008 CERTIFIED COMPANY', 'support@slr.com', 'www.slr.com', '1424(OCM)', '1245', '', 'Dr Pramod Padhan', 'DMLT', '$', 1, 'Home collection available here', '24 hours services done here', 'This report is not valid for any medico legal purpose', 0, '2020-10-05', '2020-10-05', 1, 0);



CREATE TABLE `test` (
  `ID` bigint(11) NOT NULL,
  `Description` varchar(91) NOT NULL,
  `CategoryID` bigint(11) NOT NULL,
  `ReportHeading` varchar(91) NOT NULL,
  `Charge` decimal(11,0) NOT NULL,
  `CarryOut` varchar(50) NOT NULL,
  `ReportTiming` varchar(50) NOT NULL,
  `Remarks` varchar(91) NOT NULL,
  `TypeID` bigint(11) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `IsDeleted` int(1) NOT NULL,
  `AddedBy` int(1) NOT NULL,
  `DeletedBy` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `test` (`ID`, `Description`, `CategoryID`, `ReportHeading`, `Charge`, `CarryOut`, `ReportTiming`, `Remarks`, `TypeID`, `IsActive`, `IsDeleted`, `AddedBy`, `DeletedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'test', 6, 'testttt', '500', 'seven days', 'Next days', 'fffff', 1, 1, 1, 1, 0, '2020-01-24', '2020-01-25'),
(2, 'RH Antibodies', 6, 'RH Antibodies', '600', 'Everyday', 'Next Day', '', 1, 1, 1, 1, 0, '2020-01-25', '2020-01-25'),
(3, 'Rota Virous', 4, 'Rota Virous', '1800', 'Friday', 'weekly', 'hello', 1, 1, 1, 1, 0, '2020-01-25', '2020-01-25'),
(4, 'Rota Virous LgG', 2, 'Rota Virous LgG', '500', 'everyday', '3 days', 'Remarkss', 1, 1, 0, 1, 0, '2020-01-25', '2020-10-14'),
(5, 'Seemen For ABC HG', 3, 'Seemen For ABC HG', '600', 'Everyday', 'Next day', 'Remarks', 2, 1, 0, 1, 0, '2020-01-25', '2020-10-06'),
(6, 'Rota Viros lgM', 6, 'Rota Virous', '800', 'Everyday', 'Next day', '', 1, 1, 0, 1, 0, '2020-01-26', '2020-04-05'),
(7, 'CBC Blood Complete Examination', 7, 'COMPLETE BLOOD COUNT', '800', 'Everyday', 'Next Day', 'Report', 1, 1, 0, 1, 0, '2020-01-27', '2020-03-10'),
(8, 'Haemoglobin', 4, 'HEAMATOLOGY', '500', 'Everyday', 'Same Day', '', 1, 1, 0, 1, 0, '2020-01-30', '2020-01-30'),
(9, 'ESR(Westergreen Method)', 4, 'HEAMATOLOGY', '500', 'Everyday', 'Same Day', '', 1, 1, 0, 1, 0, '2020-01-30', '2020-01-30'),
(10, 'Differential Leucicytes Count', 4, 'HEAMATOLOGY', '500', 'Everyday', 'Next Day', '', 1, 1, 0, 1, 0, '2020-01-30', '2020-01-30'),
(11, 'Urin Test', 3, 'BIOCHEMISTRY', '400', 'Everyday', 'Same Day', 'Rrin Test', 1, 1, 0, 1, 0, '2020-02-02', '2020-02-02'),
(12, 'WBC', 3, 'NA', '50', 'everyday', 'sameday', 'WBC', 1, 1, 0, 1, 0, '2020-02-18', '2020-02-18'),
(13, 'DC', 3, 'NA', '600', 'Everyday', 'Same Day', 'DC', 1, 1, 0, 1, 0, '2020-02-18', '2020-02-18'),
(14, 'RBC', 3, 'NA', '500', 'Everyday', 'Sameday', 'RBC', 1, 1, 0, 1, 0, '2020-02-18', '2020-02-18'),
(15, 'ABSOLUTE EOSINOPHIL COUNT', 8, 'ABSOLUTE EOSINOPHIL COUNT', '800', 'every day', 'next day', 'NA', 1, 1, 0, 1, 0, '2020-03-10', '2020-03-10'),
(16, 'Differential Count', 7, 'Differential Count', '800', 'Everyday', 'Next Day', 'NA', 1, 1, 0, 1, 0, '2020-03-10', '2020-03-10'),
(17, 'Plasma glucose (Random)', 1, 'PGR', '450', 'Every day', 'Next Day', 'Fasting glucose', 2, 1, 0, 1, 0, '2020-04-05', '2020-10-06'),
(18, 'PHYSICAL EXAMINATION', 1, 'PHYSICAL EXAMINATION', '850', 'Every day', 'Next day', 'Sample type Spot Urine', 1, 1, 0, 1, 0, '2020-04-05', '2020-04-05'),
(19, 'CHEMICAL EXAMINATION', 10, 'CHEMICAL EXAMINATION', '800', 'Everyday', 'After 2 days', 'Sample type  Spot Urine Method Microscopy', 1, 1, 0, 1, 0, '2020-04-11', '2020-04-11'),
(20, 'MICROSCOPIC EXAMINATION', 10, 'MICROSCOPIC EXAMINATION', '500', 'Everyday', 'Next day', 'Spot Urine', 1, 1, 0, 1, 0, '2020-04-11', '2020-10-06'),
(21, 'Test Examination', 1, 'BIOCHEMISTRY', '500', 'EveryDay', 'After 2 Day', 'Test Examination for testing dataa', 1, 1, 1, 1, 0, '2020-10-06', '2020-10-06'),
(22, 'MP QBC', 9, 'MP QBC', '500', 'Every Day', 'After 1 Day', 'MP QBC', 1, 1, 0, 1, 0, '2020-10-14', '2020-10-14');



CREATE TABLE `testparticulars` (
  `ID` bigint(11) NOT NULL,
  `TestID` bigint(11) NOT NULL,
  `TestParticulars` varchar(51) NOT NULL,
  `Units` varchar(51) NOT NULL,
  `MaleValue` varchar(51) NOT NULL,
  `FemaleValue` varchar(51) NOT NULL,
  `PartHeading` varchar(91) NOT NULL,
  `Result` int(11) NOT NULL DEFAULT 0,
  `IsAbnormal` int(1) NOT NULL DEFAULT 0,
  `IsActive` bigint(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `testparticulars` (`ID`, `TestID`, `TestParticulars`, `Units`, `MaleValue`, `FemaleValue`, `PartHeading`, `Result`, `IsAbnormal`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(2, 7, 'WBC Count', '/cu-mm', '4000-11000', '4000-11000', 'WBC', 0, 0, 1, '2020-01-30', '2020-08-18'),
(3, 7, 'R.B.C Count', 'million/ul', '4.55-5.80', '4.55-5.80', 'RBC', 0, 0, 1, '2020-01-30', '2020-03-10'),
(4, 7, 'Haemoglobin(HB)', 'gm/dl', '13-18', '13-18', 'HB', 0, 0, 1, '2020-01-30', '2020-03-10'),
(5, 7, 'P.C.V.(HCT)', '%', '39.00-51.00', '39.00-51.00', 'PCV', 0, 0, 1, '2020-01-30', '2020-06-17'),
(6, 7, 'M.C.V', 'fl', '81.00-94.00', '81.00-94.00', 'MCV', 0, 0, 1, '2020-01-30', '2020-03-10'),
(7, 10, 'Neutrophil', '%', '0.00-0.00', '0.00-0.00', 'NA', 0, 0, 1, '2020-01-30', '2020-01-30'),
(8, 10, 'Eosinophil', '%', '0.00-0.00', '0.00-0.00', 'NA', 0, 0, 1, '2020-01-30', '2020-01-30'),
(9, 10, 'Basophil', '%', '0.00-0.00', '0.00-0.00', 'NA', 0, 0, 1, '2020-01-30', '2020-01-30'),
(10, 10, 'Lymphocyte', '%', '0.00-0.00', '0.00-0.00', 'NA', 0, 0, 1, '2020-01-30', '2020-01-30'),
(11, 10, 'Monocyte', '%', '0.00-0.00', '0.00-0.00', 'NA', 0, 0, 1, '2020-01-30', '2020-01-30'),
(12, 11, 'Urine Test', 'mg/dl', '10.20-12.03', '12.03-15.20', 'Urine Test', 0, 0, 1, '2020-02-02', '2020-02-02'),
(13, 12, 'WBC', '(5000-10000)Cells/Cumm', '7400', '7400', 'NA', 0, 0, 1, '2020-02-18', '2020-02-18'),
(14, 13, 'Neutrophil', '%', '60.00', '60.00', 'NA', 0, 0, 1, '2020-02-18', '2020-02-18'),
(15, 13, 'Eosinophil', '%', '8.00', '8.00', 'NA', 0, 0, 1, '2020-02-18', '2020-02-18'),
(16, 13, 'Monocyte', '%', '8.00', '8.00', 'NA', 0, 0, 1, '2020-02-18', '2020-02-18'),
(17, 13, 'Lymphocyte', '%', '32.00', '32.00', 'NA', 0, 0, 1, '2020-02-18', '2020-02-18'),
(18, 14, 'RBC', 'Millon/Cumm', '5.30', '5.30', '', 0, 0, 0, '2020-02-18', '2020-02-18'),
(19, 7, 'M.C.H', 'Pg', '27.00-33.00', '27.00-33.00', 'MCH', 0, 0, 1, '2020-02-24', '2020-03-10'),
(20, 7, 'M.C.H.C', 'g/dl', '32.50-36.70', '32.50-36.70', 'MCHC', 0, 0, 1, '2020-02-27', '2020-03-10'),
(21, 6, 'Rota Viros Igm', '%%', '15.0-16.0', '15.0-18.0', 'Rota', 0, 0, 1, '2020-02-29', '2020-02-29'),
(22, 15, 'ABSOLUTE EOSINOPHIL COUNT', 'cells/cmm', '40-440', '40-440', 'AEC', 0, 0, 1, '2020-03-10', '2020-03-10'),
(23, 16, 'Neutrophils', '%', '40-75', '40-75', 'NA', 0, 0, 1, '2020-03-10', '2020-03-10'),
(24, 16, 'Eosinophils', '%', '0.4-7.0', '0.4-7.0', 'NA', 0, 0, 1, '2020-03-10', '2020-03-10'),
(25, 16, 'Monocytes', '%', '3-10', '3-10', 'NA', 0, 0, 1, '2020-03-10', '2020-03-10'),
(26, 16, 'Lymphocytes', '%', '20-45', '20-45', 'NA', 0, 0, 1, '2020-03-10', '2020-03-10'),
(27, 16, 'Basophils', '%', '0.2-1.0', '0.2-1.0', 'NA', 0, 0, 1, '2020-03-10', '2020-03-10'),
(28, 16, 'Neut#', '/µl', '2000-7500', '2000-7500', 'NA', 0, 0, 1, '2020-03-10', '2020-04-11'),
(29, 16, 'Lymph#', '/µl', '1300-3600', '1300-3600', 'NA', 0, 0, 1, '2020-03-10', '2020-04-11'),
(30, 16, 'Mono#', '/µl', '200-1000', '200-1000', 'NA', 0, 0, 1, '2020-03-10', '2020-04-11'),
(31, 16, 'Eo#', '/µl', '20-600', '20-600', 'NA', 0, 0, 1, '2020-03-10', '2020-04-11'),
(32, 16, 'Baso#', '/µl', '20-100', '20-100', 'NA', 0, 0, 1, '2020-03-10', '2020-04-11'),
(33, 17, 'Plasma glucose (Random)', 'mg/dl', '60-170', '60-170', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(34, 18, 'Quantity', 'ml', 'NA', 'NA', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(35, 18, 'Colour', 'NA', 'Pale Yellow', 'Pale Yellow', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(36, 18, 'Appearance', 'NA', 'Clear', 'Clear', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(37, 18, 'Deposits', 'NA', 'NA', 'NA', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(38, 18, 'Specific Gravity', 'NA', '1.015', '1.025', 'NA', 0, 0, 1, '2020-04-05', '2020-04-05'),
(39, 18, 'Reaction', 'NA', 'Acidic(5.5-7.0)', 'Acidic(5.5-7.0)', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(40, 19, 'Proteins', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 0, '2020-04-11', '2020-04-11'),
(41, 19, 'Glucose', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(42, 19, 'Ketones', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(43, 19, 'Occult Blood', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(44, 19, 'Bile Salts', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(45, 19, 'Bile Pigments', 'NA', 'Absent', 'Absent', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(46, 19, 'Urobilinogen', 'NA', 'Normal', 'Normal', 'NA', 0, 0, 1, '2020-04-11', '2020-04-11'),
(47, 22, 'MP QBC', 'NA', 'NA', 'NA', 'MP QBC', 0, 0, 1, '2020-10-14', '2020-10-14'),
(48, 20, 'Pus Cells', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(49, 20, 'R.B.C', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(50, 20, 'Epithelial Cells', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(51, 20, 'Crystals', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(52, 20, 'Casts', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(53, 20, 'Amorphous Materials', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(54, 20, 'Yeast Cells', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(55, 20, 'Bacteria', 'NA', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(56, 20, 'Spermatozoa', '/hpf', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(57, 4, 'Rota Virous LgG', 'NA', '1.2-2.0', '2.35-4.52', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(58, 5, 'Seemen For ABC HG', 'NA', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(59, 8, 'Haemoglobin', 'NA', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14'),
(60, 9, 'ESR(Westergreen Method)', 'NA', 'NA', 'NA', 'NA', 0, 0, 1, '2020-10-14', '2020-10-14');



CREATE TABLE `testresult` (
  `ReceiptNo` bigint(91) NOT NULL,
  `CategoryID` bigint(11) NOT NULL,
  `TestID` bigint(11) NOT NULL,
  `PatientID` bigint(11) NOT NULL,
  `NormalValue` varchar(51) NOT NULL,
  `ParticularsID` bigint(11) NOT NULL,
  `TestParticulars` varchar(91) NOT NULL,
  `Result` varchar(51) NOT NULL,
  `Units` varchar(91) DEFAULT NULL,
  `IsAbnormal` int(1) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `undergroup` (
  `ID` bigint(11) NOT NULL,
  `UnderGroup` varchar(31) NOT NULL,
  `Description` varchar(51) NOT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 0,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `undergroup` (`ID`, `UnderGroup`, `Description`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'BANK ACCOUNTS', 'BANK ACCOUNTS', 1, '2020-05-19', '2020-05-20'),
(2, 'BANK OCC A/C', 'BANK OCC A/C', 1, '2020-05-19', '2020-10-08'),
(3, 'BANK OD A/C', 'BANK OD A/C', 1, '2020-05-19', '2020-05-19'),
(4, 'CAPITAL A/C', 'CAPITAL A/C', 1, '2020-05-19', '2020-05-19'),
(5, 'CASH IN HAND', 'CASH IN HAND', 1, '2020-05-19', '2020-10-08'),
(6, 'CURRENT ASSETS', 'CURRENT ASSETS', 1, '2020-05-19', '2020-05-19'),
(7, 'CURRENT LIABILITIES', 'CURRENT LIABILITIES', 1, '2020-05-19', '2020-05-19'),
(8, 'DEPOSITS ASSETS', 'DEPOSITS ASSETS', 1, '2020-05-19', '2020-05-19'),
(9, 'DUTIES & TAXES', 'DUTIES &amp; TAXES', 1, '2020-05-19', '2020-05-19'),
(10, 'EXPENSES (DIRECT)', 'EXPENSES (DIRECT)', 1, '2020-05-19', '2020-05-19'),
(11, 'EXPENSES (INDIRECT)', 'EXPENSES (INDIRECT)', 1, '2020-05-19', '2020-05-19'),
(12, 'FIXED ASSETS', 'FIXED ASSETS', 1, '2020-05-19', '2020-05-19'),
(13, 'INCOME (DIRECT)', 'INCOME (DIRECT)', 1, '2020-05-19', '2020-05-19'),
(14, 'INCOME (INDIRECT)', 'INCOME (INDIRECT)', 1, '2020-05-19', '2020-05-19'),
(15, 'INVESTMENTS', 'INVESTMENTS', 1, '2020-05-19', '2020-05-19'),
(16, 'LOANS AND ADVANCES (ASSET)', 'LOANS AND ADVANCES (ASSET)', 1, '2020-05-19', '2020-07-03'),
(17, 'LOANS LIABILITY', 'LOANS LIABILITY', 1, '2020-05-19', '2020-05-19'),
(18, 'MISC EXPENCES (ASSETS)', 'MISC EXPENCES (ASSETS)', 1, '2020-05-19', '2020-05-19'),
(19, 'PROVISIONS', 'PROVISIONS', 1, '2020-05-19', '2020-05-19'),
(20, 'PURCHASE ACCOUNTS', 'PURCHASE ACCOUNTS', 1, '2020-05-19', '2020-05-19'),
(21, 'RESERVES & SURPLUS', 'RESERVES &amp; SURPLUS', 1, '2020-05-19', '2020-05-19'),
(22, 'RETAINED EARNINGS', 'RETAINED EARNINGS', 1, '2020-05-19', '2020-05-19'),
(23, 'SECURED LOANS', 'SECURED LOANS', 1, '2020-05-19', '2020-05-19'),
(24, 'STOCK IN HAND', 'STOCK IN HAND', 1, '2020-05-20', '2020-05-20'),
(25, 'SUNDRY CREDITORS', 'SUNDRY CREDITORS', 1, '2020-05-20', '2020-05-20'),
(26, 'SUNDRY DEBTORS', 'SUNDRY DEBTORS', 1, '2020-05-20', '2020-05-20'),
(28, 'UNSECURED LOANS', 'UNSECURED LOANS', 1, '2020-05-20', '2020-10-08');



CREATE TABLE `units` (
  `ID` bigint(11) NOT NULL,
  `Unit` varchar(25) DEFAULT NULL,
  `Description` varchar(51) DEFAULT NULL,
  `IsActive` int(1) NOT NULL DEFAULT 1,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `units` (`ID`, `Unit`, `Description`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'mmg', 'mmg', 1, '2020-04-24', '2020-10-06'),
(2, 'mmgg', 'gg', 1, '2020-04-24', '2020-04-24'),
(3, 'mmbh', 'bmhj', 1, '2020-04-24', '2020-04-24'),
(4, '/ul', 'unit for test', 1, '2020-04-24', '2020-04-24'),
(5, 'fgg', 'fgg', 1, '2020-04-24', '2020-04-26'),
(6, 'gmm', 'gm', 1, '2020-04-24', '2020-10-06'),
(7, '%', 'percent', 1, '2020-04-24', '2020-04-24'),
(11, 'gm', 'gm', 1, '2020-04-25', '2020-10-06');



CREATE TABLE `vendor` (
  `ID` bigint(11) NOT NULL,
  `Vendor` varchar(91) NOT NULL,
  `CompanyID` bigint(11) NOT NULL,
  `LedgerGroupID` bigint(11) NOT NULL,
  `Address` varchar(91) NOT NULL,
  `ContactNo` bigint(15) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);


ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);


ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);


ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);


ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);


ALTER TABLE `acc_transaction`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `advancesalary`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `assignedleave`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `bloodgroup`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `designation`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `doctorcommision`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `empattendanceregistration`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employeeadvance`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employeeallowance`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employeeleave`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employeesalaryscheme`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `employeesecurity`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `globalsettings`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `ledger`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `ledgergroup`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `nationality`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `paymentmode`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `receipt`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ReceiptNo` (`ReceiptNo`);


ALTER TABLE `salary`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `salarypayment`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `salaryscheme`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `securityamountdue`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `securitydeposit`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `testparticulars`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `undergroup`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `units`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `vendor`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;


ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `acc_transaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;


ALTER TABLE `advancesalary`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `assignedleave`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `bloodgroup`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `category`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;


ALTER TABLE `department`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `designation`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `doctor`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;


ALTER TABLE `doctorcommision`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;


ALTER TABLE `empattendanceregistration`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `employee`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `employeeadvance`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `employeeallowance`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `employeeleave`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `employeesalaryscheme`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;


ALTER TABLE `employeesecurity`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `globalsettings`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `item`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `itemtype`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `leavetype`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `ledger`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;


ALTER TABLE `ledgergroup`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;


ALTER TABLE `nationality`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `patient`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;


ALTER TABLE `paymentmode`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `purchase`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `purchaseitems`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `receipt`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;


ALTER TABLE `salary`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `salarypayment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `salaryscheme`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `securityamountdue`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `securitydeposit`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


ALTER TABLE `settings`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `test`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `testparticulars`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;


ALTER TABLE `undergroup`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;


ALTER TABLE `units`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `vendor`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;
