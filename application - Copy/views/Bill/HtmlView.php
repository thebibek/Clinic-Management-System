<html>
    <head>
        <style>
            body {font-family: sans-serif;
                  font-size: 10pt;
            }
            p {	margin: 0pt; }

            td { vertical-align: top; }

            table.items thead tr td { 
                background-color: #414550;
                text-align: center;
                border: 1px solid #414550;
                font-variant: small-caps;
                color:#fff;
                font-weight:700;
                font-size:1rem;
                box-shadow:none;

            }
            table.items tbody tr td{
                border: 1px solid #414550;
            } 


            .items td.blanktotal {
                background-color: #EEEEEE;

                background-color: #FFFFFF;


            }
            .items td.totals {
                text-align: center;

            }
            .items td.cost {
                text-align: center;
            }
            table.header-section{
                width:100%;
                border-collapse :  collapse;


            }
            table.header-section tr td {

                padding : 8px;
                text-align:left;
                vertical-align:middle;
            }
            .rem-3{
                font-size:3rem;
            }
            .bg-black{
                background-color:#414550;
            }
            .bg-red{
                background-color:#D20E27;
            }
            .text-red{
                color:#D20E27;
            }
            .text-white{
                color:#fff;
            }
            .text-right{
                text-align:right;
            }

            .mr-t-2{
                margin-top:6rem;
            }

        </style>
    </head>
    <body>
        <?php
        //rs1 patient doctor details
        //rs2 settings

        if (isset($rs1) && isset($rs2)) {
            $patientName = $rs1['FirstName'] . ' ' . $rs1['LastName'];
            $doctorName = $rs1['Salutation'] . ' ' . $rs1['DrFirstName'] . ' ' . $rs1['DrLastName'];
            $patientAge = $rs1['Age'];
            $referDoctor = $rs1['Salutation'] . ' ' . $rs1['DrFirstName'] . ' ' . $rs1['DrLastName'];

            if ($rs1['Gender'] == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            $receiptDate = $rs1['ReceiptDate'];
            $reportNo = $rs1['ReceiptNo'];

            $dotorMobile = $rs1['DotorMobile'];
            $patientMobile = $rs1['PatientMobile'];

            //patient address
            $patientAddress = $rs1['Address'];
            //TechnicianName or pathologist
            $technicianName = $rs2['TechnicianName'];
            //currency
            $currency = $rs2['Currency'];
        }
        ?>

        <table class="header-section">
            <tbody>
                <tr>
                    <td width="25%">
                        <p>Patient Name:<p>
                        <p style="font-weight:bold;color:#D20E27"><?php echo $patientName; ?></p>
                        <p><?php echo $patientMobile; ?></p>
                        <p><?php echo $patientAddress; ?></p>
                    </td>
                    <td width="20%">
                        <p>Report No</p>
                        <p style="font-weight:bold;color:#D20E27"><?php echo $reportNo; ?></p>
                    </td>
                    <td width="30%">
                        <p>Ref By</p>
                        <p><?php echo $doctorName; ?></p>
                    </td>
                    <td width="25%">
                        <p>Pathologist</p>
                        <p><?php echo $technicianName; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
            <thead class="bg-black">
                <tr>
                    <td width="10%">SL</td>
                    <td width="15%">Report Date</td>
                    <td width="45%">Test Description</td>
                    <td width="15%">Charges</td>
                    <td width="15%">Amount</td>
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                <?php
                $count = 1;
                if (isset($items)) {
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            ?>
                            <tr>
                                <td align="center">#<?php echo $count; ?></td>
                                <td align="center"><?php echo $receiptDate; ?></td>
                                <td align="center"><?php echo $item['TestDescription']; ?></td>
                                <td class="cost"><?php
                                    echo $currency . " " . $item['Charges'] . '.' . '00';
                                    ;
                                    ?></td>
                                <td class="cost"><?php
                                    echo $currency . " " . $item['Charges'] . '.' . '00';
                                    ;
                                    ?></td>
                            </tr>
                            <?php
                            $count++;
                        }
                    }
                }
                ?>
                <!-- END ITEMS HERE -->
                <tr>
                    <td class="blanktotal" colspan="3" rowspan="6"></td>
                    <td class="totals">Subtotal:</td>
                    <td class="totals cost"><?php
                        if (isset($subtotal)) {
                            echo $currency . " " . $subtotal;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td class="totals">Discount:</td>
                    <td class="totals cost"><?php
                        if (isset($discount)) {
                            echo $currency . " " . $discount;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td class="totals bg-red"><b class="text-white">TOTAL:</b></td>
                    <td class="totals cost bg-red"><b class="text-white"><?php
                            if (isset($total)) {
                                echo $currency . " " . $total;
                            }
                            ?></b></td>
                </tr>
                <tr>
                    <td class="totals">Paid Amount:</td>
                    <td class="totals cost"><?php
                        if (isset($paid)) {
                            echo $currency . " " . $paid;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td class="totals"><b>Balance due:</b></td>
                    <td class="totals cost">
                        <b>
                            <?php
                            if (isset($due)) {
                                echo $currency . " " . $due;
                            }
                            ?>
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" class="mr-t-2">
            <tr>
                <td width="50%"></td>
                <td width="50%" class="text-right">
                    <p>Signature</p>
                    <p><?php echo $technicianName; ?></p>
                    <p>(Consultant Pathologist)</p>
                </td>
            </tr>
        </table>
        <div style="text-align: center; font-weight: 500;font-style: italic;">THANK YOU,VISIT AGAIN</div>
    </body>
</html>