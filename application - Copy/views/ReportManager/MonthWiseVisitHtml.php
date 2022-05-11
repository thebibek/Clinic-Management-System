<h4 style="text-align: center">Report</h4>
<p style="text-align: center"><?php echo isset($monthName)? $monthName : 'XXXXX'; ?> - <?php echo date('Y');?></p>
<table class="table table-bordered border-warning table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Receipt No</th>
            <th>MobileNo</th>
            <th>NetAmount</th>
            <th>PaidAmount</th>
            <th>DueAmount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $sumPaid = 0;
        $sumDue = 0;
        if (isset($result) && !empty($result)) {
            foreach ($result as $rs) {
                $sumPaid = $sumPaid + $rs['PaidAmount'];
                $sumDue = $sumDue + $rs['DueAmount'];
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $rs['FirstName'] . " " . $rs['LastName']; ?></td>
                    <td><?php echo $rs['ReceiptNo'] ?></td>
                    <td><?php echo $rs['MobileNo'] ?></td>
                    <td><?php echo $rs['NetAmount'] ?></td>
                    <td><?php echo $rs['PaidAmount'] ?></td>
                    <td><?php echo $rs['DueAmount'] ?></td>

                </tr>
                <?php
                $count++;
            }
        }
        ?>
        <tr>
            <td colspan="5" class="text-end"><strong>Total</strong></td>
            <td><strong><?php echo number_format($sumPaid, 2, '.',','); ?><strong></td>    
            <td class="bdr-r-0"><strong><?php echo number_format($sumDue, 2, '.',','); ?><strong></td>    
        </tr>
    </tbody>
</table>