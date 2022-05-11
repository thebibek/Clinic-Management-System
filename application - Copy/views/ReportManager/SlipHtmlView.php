<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            .text-center{
                text-align: center;
            }

            td, th {
                border: 1px solid #000;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>

        <?php
        if (isset($rs1) && isset($rs2)) {
            $salaryMonth = $rs1['SalaryMonth'];
            $monthName = $rs1['Month'];
            $year = $rs1['Year'];
            $company = $rs2['LabName'];
            $email = $rs2['Email'];
            $website = $rs2['Website'];
            $slipNo = $rs1['SlipNo'];
            $name = $rs1['Salutation'] . ' ' . $rs1['FirstName'] . ' ' . $rs1['LastName'];
            $dept = $rs1['Department'];
            $designation = $rs1['Designation'];
            $empCode = $rs1['EmployeeCode'];
            $bank = $rs1['BankName'];
            $acNo = $rs1['BankAccountNo'];
            $totalContribution = $rs1['TotalContribution'];
            $paymentMode = "XX";
            $chequeNo = "XXXX";
            $chequeDate = "XXXXX";
            $bankName = $rs1['BankName'];
            $basicSalary = $rs1['BasicSalary'];
            $totalAllowance = $rs1['TotalAllowance'];
            $grossSalary = $rs1['GrossSalary'];
            $totalDeduction = $rs1['TotalDeduction'];
            $advanceReceived = $rs1['AdvanceReceived'];
            $netSalary = $rs1['NetSalary'];

            if ($rs1['JobType'] == 1) {
                $jobType = 'PERMANENT';
            } else {
                $jobType = 'TEMPRORARY';
            }

            if ($rs1['EmployeeType'] == 1) {
                $empType = 'PERMANENT';
            } else {
                $empType = 'TEMPRORARY';
            }
            $present = $rs1['Present'];
        }

        if (empty($rs3)) {
            $rs3 = [];
        }

        if (empty($rs4)) {
            $rs4 = [];
        }
        
        if(empty($rs5)){
            $rs5 = [];
        }
        ?>

        <table>
            <tr>
                <td colspan="6" class="text-center"><p>Salary Slip  - <?php echo $monthName; ?> <?php echo $year; ?></p></td>
            </tr>
            <tr>
                <td class="text-center">
                    <img src="<?php echo base_url('assets/img/logo.png'); ?>" height="50" width="50">
                </td>
                <td colspan="5">
                    <p><?php echo $company; ?></p>
                    <p><?php echo $email; ?>(<?php echo $website; ?>)</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Salary Slip No : </strong><span> <?php echo $slipNo; ?> </span><br>
                    <strong>Name : </strong><span> <?php echo $name; ?> </span><br>
                    <strong>Dept : </strong><span> <?php echo $dept; ?> </span><br>
                    <strong>Design : </strong><span> <?php echo $designation; ?> </span>
                </td>
                <td colspan="2">
                    <b>Salary Month : </b><span> <?php echo $monthName; ?> </span><br>
                    <b>Code : </b><span><?php echo $empCode; ?></span><br>
                    <b>Bank Name : </b><span> <?php echo $bank; ?> </span><br>
                    <b>A/C No : </b><span> <?php echo $acNo; ?> </span>
                </td>
                <td colspan="2">
                    <b>Date : </b><span><?php echo $salaryMonth; ?></span><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Job Type : </strong><span><?php echo $jobType; ?></span></td>
                <td colspan="2"><strong>Emp Type : </strong><span><?php echo $empType; ?></span></td>
                <td colspan="2"><strong>Attendance : </strong><span><?php echo $present; ?></span></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Over Time(In Hrs) : </strong><span>0</span></td>
                <td colspan="2"><strong>Over Time Amount : </strong><span>0.00</span></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>Allowance</td>
                <td>Amount</td>
                <td>Deduction</td>
                <td>Amount</td>
                <td>Contribution</td>
                <td>Amount</td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($rs3 as $v) {
                        echo $v['AllowanceName'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($rs3 as $v) {
                        echo $v['Allowance'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($rs4 as $v) {
                        echo $v['AllowanceName'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($rs4 as $v) {
                        echo $v['Deduction'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($rs5 as $v) {
                        echo $v['AllowanceName'] . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($rs5 as $v) {
                        echo $v['Contribution'] . '<br>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>Total Contribution : </strong><span><?php echo $totalContribution;?></span><br>
                    <strong>Payment Mode : </strong><span><?php echo $paymentMode;?></span><br>
                    <strong>Cheque No : </strong><span><?php echo $chequeNo;?></span><br>
                    <strong>Cheque Date : </strong><span><?php echo $chequeDate;?></span><br>
                    <strong>Bank Name : </strong><span><?php echo $bankName;?></span>
                </td>
                <td colspan="3">
                    <strong>Basic Salary : </strong><span><?php echo $basicSalary;?></span><br>
                    <strong>Total Allowance : </strong><span><?php echo $totalAllowance;?></span><br>
                    <strong>Gross Salary : </strong><span><?php echo $grossSalary;?></span><br>
                    <strong>Total Deduction : </strong><span><?php echo $totalDeduction;?></span><br>
                    <strong>Total Recovery Of Advance : </strong><span><?php echo $advanceReceived;?></span><br>
                    <strong>Net Salary : </strong><span><?php echo $netSalary;?></span><br>
                </td>
            </tr>
            <tr>
                <td colspan="3">Signature</td>
                <td colspan="3"><?php echo $salaryMonth;?></td>
            </tr>
        </table>
    </body>
</html>
