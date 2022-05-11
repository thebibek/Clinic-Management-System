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

            .items td.cost {
                text-align: center;
            }
            table.header-section{
                width:100%;
                border-collapse :  collapse;


            }
            table.header-section tr td {

                padding : 5px;
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
            hr{
                color:#000;
            }

        </style>
    </head>
    <body>
        <?php
        //rs1 patient doctor details
        //rs2 settings

        if (isset($rs1) && isset($rs2)) {

            //purchase date 
            $purchaseDate = $rs1['PurchaseDate'];
            $billAmount = $rs1['BillAmount'];

            //currency
            $currency = $rs2['Currency'];
        }
        ?>

        <table width="100%">
            <tr>
                <td width="50%">
                    <p>From</p>
                    <h4><?php echo $rs1['Vendor']; ?></h4>
                    <p><?php echo $rs1['Address'] ?></p>
                    <p>Ph No:<?php echo $rs1['ContactNo']; ?></p>
                    <p>Email : xxxxxxxxxxxxxx</p>
                </td>
                <td width="50%">
                    <p>Ship To</p>
                    <h4><?php echo $rs2['LabName']; ?></h4>
                    <p><?php echo $rs2['Address']; ?></p>
                    <p>Ph No:<?php echo $rs2['PhoneNo1']; ?>,<?php echo $rs2['PhoneNo2']; ?></p>
                </td>
            </tr>
        </table>
        <hr>
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">
            <thead class="bg-black">
                <tr>
                    <td width="10%">SL</td>
                    <td width="15%">Purchase Date</td>
                    <td width="15%">Item Name</td>
                    <td width="20%">Description</td>
                    <td width="10%">Quantity</td>
                    <td width="15%">Price</td>
                    <td width="15%">Total</td>
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
                                <td align="center"><?php echo $purchaseDate; ?></td>
                                <td align="center"><?php echo $item['ItemName']; ?></td>
                                <td align="center"><?php echo $item['Description']; ?></td>
                                <td align="center">
                                    <?php echo $item['Quantity']; ?>
                                </td>
                                <td align="center">
                                    <?php
                                    echo $currency . " " . $item['Rate'];
                                    ?>
                                </td>
                                <td align="center"><?php echo $currency . " " . $item['Total']; ?></td>
                            </tr>
                            <?php
                            $count++;
                        }
                    }
                }
                ?>
                <!-- END ITEMS HERE -->

                <tr>
                    <td class="totals bg-red text-right" colspan="6"><b class="text-white">TOTAL &nbsp;</b></td>
                    <td class="totals cost bg-red">
                        <b class="text-white"><?php
                            if (isset($billAmount)) {
                                echo $currency . " " . $billAmount;
                            }
                            ?>
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" class="mr-t-2">
            <tr>
                <td width="50%">
                </td>
                <td width="50%" class="text-right">
                    <p>Signature</p>
                    <p></p>
                    <p>(Director)</p>
                </td>
            </tr>
        </table>
        <div style="text-align: center; font-weight: 500;font-style: italic;">THANK YOU,VISIT AGAIN</div>
    </body>
</html>