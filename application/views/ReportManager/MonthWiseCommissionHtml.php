<h4 style="text-align: center">Report</h4>
<p style="text-align: center"><?php echo isset($monthName)? $monthName : 'XXXXX'; ?> - <?php echo date('Y');?></p>
<table class="table table-bordered border-warning table-sm report">
    <thead>
        <tr class="bg-white">
            <th class="bdr-l-0">#</th>
            <th>Name</th>
            <th class="bdr-r-0">MobileNo</th>
            <th>Receipt No</th>
            <th>NetAmount</th>
            <th>CommisionAmount</th>
            <th class="bdr-r-0">PayAmount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $sumComm = 0;
        $sumPayAmt = 0;
        
        if (isset($result) && !empty($result)) {
            foreach ($result as $rs) {
                $sumComm = $sumComm + $rs['CommisionAmount'];
                $sumPayAmt = $sumPayAmt + $rs['PayAmount'];
                ?>
                <tr>
                    <td class="bdr-l-0"><?php echo $count; ?></td>
                    <td><?php echo $rs['Salutation']." ".$rs['FirstName'] . " " . $rs['LastName']; ?></td>
                    <td><?php echo $rs['MobileNo'] ?></td>
                    <td><?php echo $rs['ReceiptNo'] ?></td>
  
                    <td><?php echo $rs['NetAmount'] ?></td>
                    <td><?php echo $rs['CommisionAmount'] ?></td>
                    <td class="bdr-r-0"><?php echo $rs['PayAmount'] ?></td>

                </tr>
                <?php
                $count++;
            }
        }
        ?>

        <tr>
            <td colspan="5" class="text-right bdr-l-0"><strong>Total</strong></td>
            <td><strong><?php echo number_format($sumComm, 2, '.', ','); ?><strong></td>    
            <td class="bdr-r-0"><strong><?php echo number_format($sumPayAmt, 2, '.', ','); ?><strong></td>    
        </tr>
</tbody>
</table>