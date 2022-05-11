<script>
<?php
$cYear = date('Y');
$pYear = date('Y') - 1;
?>
    
    
var options = {
          series: [{
          name: 'Expense',
          data: [
              <?php echo isset($expenses) ? $expenses[1] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[2] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[3] : 0; ?>,
              <?php echo isset($expenses) ? $expenses[4] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[5] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[6] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[7] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[8] : 0; ?>, 
              <?php echo isset($expenses) ? $expenses[9] : 0; ?>
              ]
        }, {
          name: 'Revenue',
          data: [
                <?php echo isset($sales) ? $sales[1] : 0; ?>, 
                <?php echo isset($sales) ? $sales[2] : 0; ?>, 
                <?php echo isset($sales) ? $sales[3] : 0; ?>, 
                <?php echo isset($sales) ? $sales[4] : 0; ?>, 
                <?php echo isset($sales) ? $sales[5] : 0; ?>, 
                <?php echo isset($sales) ? $sales[6] : 0; ?>, 
                <?php echo isset($sales) ? $sales[7] : 0; ?>, 
                <?php echo isset($sales) ? $sales[8] : 0; ?>, 
                <?php echo isset($sales) ? $sales[9] : 0; ?>]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();    
    





</script>