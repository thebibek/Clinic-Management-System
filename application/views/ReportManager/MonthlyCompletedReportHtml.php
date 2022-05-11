<h4 style="text-align: center">Report</h4>
<p style="text-align: center"><?php echo isset($monthName)? $monthName : 'XXXXX'; ?> - <?php echo date('Y');?></p>
<table class="table table-bordered border-warning table-striped mt-5 table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Receipt No</th>
            <th>TotalAmount</th>
            <th>NetAmount</th>
            <th>PaidAmount</th>
            <th>DueAmount</th>
            <th>Report Status</th>
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
                    <td class="bdr-l-0"><?php echo $count; ?></td>
                    <td><?php echo $rs['ReceiptNo']; ?></td>
                    <td><?php echo $rs['TotalAmount']; ?></td>
                  
                    <td><?php echo $rs['NetAmount']; ?></td>
                    <td><?php echo $rs['PaidAmount']; ?></td>
                    <td class="bdr-r-0"><?php echo $rs['DueAmount']; ?></td>
                    <td class="bdr-r-0 text-green">Completed</td>
                </tr>
                <?php
                $count++;
            }
        }
        ?>
        <tr>
            <td colspan="4" class="text-end"><strong>Total</strong></td>
            <td><strong><?php echo number_format($sumPaid, 2, '.',','); ?><strong></td>    
            <td><strong><?php echo number_format($sumDue, 2, '.',','); ?><strong></td>
            <td></td>            
        </tr>
    </tbody>
</table>