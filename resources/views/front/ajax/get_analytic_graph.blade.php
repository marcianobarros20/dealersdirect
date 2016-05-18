<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "This Month Analysis"
				},
				data: [{
					type: "column",
					dataPoints: <?php echo $request_queues;?>,
				}]
			});
			chart.render();
			console.log(chart);
		}
	</script>
	<script src="<?php echo url('/');?>/public/front_end/caravan/canvasjs.min.js"></script>
	<div id="chartContainer" style="height: 400px; width: 100%;"></div>