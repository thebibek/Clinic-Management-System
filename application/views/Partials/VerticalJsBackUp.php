<script>

$(function () {

	var d1, d2, d3, data, chartOptions;
        
	d1 = [
		[gd(2019,12,1), <?php echo rand(100,1000)?>], 
                [gd(2020,1,1), 700], 
                [gd(2020,2,1), 1000], 
                [gd(2020,3,1), 600],
		[gd(2020,4,1), 350], 
                [gd(2020,5,1), 450], 
                [gd(2020,6,1), 390],
                [gd(2020,7,1), 350], 
                [gd(2020,8,1), 450], 
                [gd(2020,9,1), 390],
                [gd(2020,10,1), 400],
                [gd(2020,11,1), 500]
	];

	d2 = [
		[gd(2019,12,1), <?php echo rand(100,1000);?>], 
                [gd(2020,1,1), 600], 
                [gd(2020,2,1), 300], 
                [gd(2020,3,1), 350],
		[gd(2020,4,1), 500], 
                [gd(2020,5,1), 600], 
                [gd(2020,6,1), 400],
                [gd(2020,7,1), 650], 
                [gd(2020,8,1), 700], 
                [gd(2020,9,1), 690],
                [gd(2020,10,1), 398],
                [gd(2020,11,1), 500]
	];

	data = [{
		label: 'Expenses',
		data: d1
	},{
		label: 'Sales',
		data: d2
	}];

	chartOptions = {
		xaxis: {
			min: (new Date(2019, 11)).getTime(),
			max: (new Date(2020, 11)).getTime(),
			mode: "time",
			tickSize: [1, "month"],
			monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			tickLength: 0
		},
		grid:{
      hoverable: true,
      clickable: false,
      borderWidth: 1,
      tickColor: '#dfe2f0',
      borderColor: '#dfe2f0',
    },
		bars: {
			show: true,
			barWidth: 24 * 24 * 60 * 60 * 300,
			fill: true,
			lineWidth: 1,
			order: true,
			lineWidth: 0,
			fillColor: { colors: [ { opacity: 1 }, { opacity: 1 } ] }
		},
		shadowSize: 0,
		tooltip: true,
		tooltipOpts: {
			content: '%s: %y'
		},
		colors: ['#ff0000', '#009900', '#ffda68', '#3fcbca'],
	}

	var holder = $('#vertical-chart');

	if (holder.length) {
		$.plot(holder, data, chartOptions );
	}
});     

function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}



</script>