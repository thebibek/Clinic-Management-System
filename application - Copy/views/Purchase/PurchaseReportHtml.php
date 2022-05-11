<h4 style="text-align: center">Purchase Report</h4>
<p style="text-align: center">From :<?php echo isset($fromDate) ? $fromDate : "xx-xx-xxxx"; ?> To : <?php echo isset($toDate) ? $toDate : "xx-xx-xxxx"; ?></p>
<table class="table table-bordered border-warning  table-sm">
    <thead>
        <tr class="bg-white">
            <th class="bdr-l-0">#</th>
            <th>Item Type</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th class="bdr-r-0">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $total = 0;
        if (isset($result) && !empty($result)) {
            foreach ($result as $rs) {
                $total = $total + $rs['Total'];
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $rs['ItemType']; ?></td>
                    <td><?php echo $rs['ItemName']; ?></td>
                    <td><?php echo $rs['Description']; ?></td>
                    <td><?php echo $rs['Quantity']; ?></td>
                    <td><?php echo $rs['Rate']; ?></td>
                    <td><?php echo $rs['Total']; ?></td>
                </tr>
                <?php
                $count++;
            }
        }
        ?>
        <tr>
            <td colspan="6" class="text-end"><strong>Total</strong></td>
            <td class="bdr-r-0"><strong><?php echo number_format($total, 2, '.', ','); ?></strong></td>    
        </tr>
    </tbody>
</table>