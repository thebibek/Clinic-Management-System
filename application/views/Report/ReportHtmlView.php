<!DOCTYPE html>
<html>
    <head>
        <style>
            .customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 15px;
            }

            .customers td, .customers th {

                padding: 6px;
            }

            .text-center{
                text-align: center;
            }

            .text-red{
                color:red;
            }
            .text-bold{
                font-weight: bold;
            }

            .text-right{
                text-align: right;
            }
            .text-left{
                text-align:left;
            }
            .bold{
                font-weight: 700 !important;
            }

            .customers tr:nth-child(even){background-color: #f2f2f2;}

            .customers tr:hover {background-color: #ddd;}

            .customers th {
                padding-top: 8px;
                padding-bottom: 8px;
                text-align: left;
                background-color: #b3b300;
                color: white;
            }

            #ResultHeader {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                background-color: #1A1A1A;
            }
            #ResultHeader tr td{
                color:#FFF;
                padding: 6px;

            }
            .bg-sky{
                background:#008ae6;
                color:#fff;

            }
        </style>
    </head>
    <body>
        <?php
        if (isset($rs1) && isset($rs2)) {
            $patientName = $rs1['FirstName'] . ' ' . $rs1['LastName'];
            $doctorName = $rs1['DrFirstName'] . ' ' . $rs1['DrLastName'];
            $patientAge = $rs1['Age'];
            $referDoctor = $doctorName;

            if ($rs1['Gender'] == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            $receiptDate = $rs1['ReceiptDate'];
            $printDate = $rs1['PrintDate'];

            $reportNo = $rs1['ReceiptNo'];

            $dotorMobile = $rs1['DotorMobile'];
            $patientMobile = $rs1['PatientMobile'];
        }
        ?>

        <table width="100%">
            <tr>
                <td width="20%" class="text-left">Patient Name:</td>
                <td width="35%" class="text-left"><?php echo $patientName; ?></td>
                <td width="5%"></td>
                <td width="20%" class="text-left">Receipt Date:</td>
                <td width="20%" class="text-left"><?php echo $receiptDate; ?></td>
            </tr>
            <tr>
                <td width="20%" class="text-left">Age/Gender:</td>
                <td width="20%" class="text-left"><?php echo $patientAge; ?> Yrs / <?php echo $gender; ?></td>
                <td width="20%"></td>
                <td width="20%" class="text-left">Print Date:</td>
                <td width="20%" class="text-left"><?php echo $printDate; ?></td>
            </tr>
            <tr>
                <td width="20%" class="text-left">Refered By:</td>
                <td width="20%" class="text-left"><?php echo $referDoctor; ?></td>
                <td width="20%"></td>
                <td width="20%" class="text-left">Report No:</td>
                <td width="20%" class="text-left"><?php echo $reportNo; ?></td>
            </tr>
            <tr>
                <td width="20%" class="text-left">Mobile#:</td>
                <td width="20%" class="text-left"><?php echo $patientMobile; ?></td>
                <td width="20%"></td>
                <td width="20%" class="text-left"> Specimen:</td>
                <td width="20%" class="text-left">Taken in Lab</td>
            </tr>
        </table>    
        <hr style="color:black;box-shadow: none;border:none">
        <table id="ResultHeader">
            <tr>
                <td width="40%" >Investigation</td>
                <td width="20%" >Observed Value</td>
                <td width="20%" >Unit</td>
                <td width="20%" >Reference Interval</td>
            </tr>
        </table>
        <?php
        if (isset($group)) {
            if (!empty($group)) {
                foreach ($group as $key => $gr) {
                    foreach ($gr as $k => $g) {
                        ?>
                        <table class="customers">
                            <tr>
                                <th colspan="4"><?php echo $key; ?></th>
                            </tr>
                            <tr>
                                <td colspan="4" class="bg-sky text-center"><?php echo $k; ?></td>
                            </tr>
                            <?php
                            foreach ($g as $v) {
                                ?>
                                <tr>
                                    <td width="40%"><?php echo $v['TestParticulars']; ?> </td>
                                    <?php
                                    if ($v['IsAbnormal'] == 1) {
                                        echo '<td width="20%" class="text-red text-bold">' . $v['Result'] . '</td>';
                                    } else {
                                        echo '<td width="20%">' . $v['Result'] . '</td>';
                                    }
                                    ?>
                                    <td width="20%"><?php echo $v['Units']; ?></td>
                                    <td width="20%"><?php echo $v['NormalValue']; ?></td>
                                </tr> 
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                }
            }
        }
        ?>
    </body>
</html>
