@extends('front/layout/dealerfrontendanalytics_template')
@section('content')
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

	<section class="selection_area">
        <div class="container">
            <h2 class="profile_head center-block"><?php echo Session::get('dealer_name');?> Your Reminder List</h2>

            <!--Sucessfullly updated Admin Details-->
            @if(Session::get('success'))
            <div class="col-xs-4"></div>
            <div class="alert alert-success col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('success') }} 
            <a href="#" class="close" data-dismiss="alert">×</a>
            </div>
            <div class="col-xs-4"></div>
            @endif

            <!--Failed to update Admin Details-->
            @if(Session::get('error'))
            <div class="col-xs-4"></div>
            <div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;">
            <?php $err_msgs = Session::get('error'); ?>
            @foreach($err_msgs->all() as $err)
            {{ $err }}
            @endforeach
            <a href="#" class="close" data-dismiss="alert">×</a>
            </div>
            <div class="col-xs-4"></div>
            @endif
   		</div><!--  /container -->
 </section>
<section class="brand_section">
    <div class="container admin-cont">
	    <div class="graphbox">
			<div id="chartContainer" style="height: 400px; width: 100%;"></div>
		</div>
	</div>
</section>
@stop