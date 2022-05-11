<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border-bottom : 0.001rem solid #000;
                text-align: left;
                padding: 4px;

            }

            td{
                font-size: 12px;
            }

            h4{
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            .right{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <h4>Doctor List</h4>
        <table>
            <thead>  
                <tr>
                    <th width="4%">#</th>  
                    <th>Doctor</th>
                    <th>Dept</th>
                    <th>Hospital</th>
                    <th>Contact</th>
                    <th width="12%">Comm(%)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                if (isset($doctors) && !empty($doctors)) {
                    foreach ($doctors as $d) {
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $d['Salutation'] . " " . $d['FirstName'] . " " . $d['LastName']; ?></td>
                            <td><?php echo $d['Department']; ?></td>
                            <td><?php echo $d['Hospital'] ?></td>

                            <td><?php echo $d['MobileNo']; ?></td>
                            <td class="right">5</td>
                        </tr>
                        <?php
                        $count++;
                    }
                }
                ?> 
            </tbody>
        </table>
    </body>
</html>
