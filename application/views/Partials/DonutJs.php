<script>
<?php 

$data[0]['TestDescription']="xxxxxxx";
$data[0]['total']= 0;

$data[1]['TestDescription']="xxxxxxx";
$data[1]['total']= 0;

$data[2]['TestDescription']="xxxxxxx";
$data[2]['total']= 0;

$data[3]['TestDescription']="xxxxxxx";
$data[3]['total']= 0;

$data[4]['TestDescription']="xxxxxxx";
$data[4]['total']= 0;
 
 if(isset($testsCount) && !empty($testsCount)){
    $data = $testsCount;
 }
 
 //echo '<pre>';
 //print_r($data);
 //exit();
?>    

ctx = document.getElementById('myChart').getContext('2d');
chart = new Chart(ctx, {
    type: 'pie',    
    data: {
        datasets: [{
            label: 'Colors',
            data: [ Math.floor(<?php echo $data[0]['total'];?>), 
                    Math.floor(<?php echo $data[1]['total'];?>), 
                    Math.floor(<?php echo $data[2]['total'];?>), 
                    Math.floor(<?php echo $data[3]['total'];?>), 
                    Math.floor(<?php echo $data[4]['total'];?>), 
                 
                ],
            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
        }],
        labels: ['<?php echo $data[0]['TestDescription'].'('.$data[0]['total'].')'; ?>',
            '<?php echo $data[1]['TestDescription'].'('.$data[1]['total'].')'; ?>',
            '<?php echo $data[2]['TestDescription'].'('.$data[2]['total'].')'; ?>',
            '<?php echo $data[3]['TestDescription'].'('.$data[3]['total'].')'; ?>',
            '<?php echo $data[4]['TestDescription'].'('.$data[4]['total'].')'; ?>'
           
         ]
    },
    options: {
        responsive: true,
        title:{
            display: true,
            text: "Monthly Test Performed"
        }
    }
});


</script>