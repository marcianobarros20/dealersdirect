@extends('front/layout/dealerfrontendanalytics_template')
@section('content')	
<script type="text/javascript">
            $(function () {
                // Create the chart
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Monthly Analysis'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Quantity'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> <br/>'
                    },

                    series: [{
                        name: 'Monthly Graphs',
                        colorByPoint: true,
                        data: <?php echo $request_queues;?>
                    }],
                    drilldown: {
                        series: [
                        {
                            name: 'REQUESTs',
                            id: 'REQUESTs',
                            data: [ <?php echo $requ; ?>
                            ]
                        }, 
                        {
                            name: 'BIDs',
                            id: 'BIDs',
                            data: [<?php echo $bidu; ?>
                            ]
                        }, 
                        {
                            name: 'CONTACTs',
                            id: 'CONTACTs',
                            data: [<?php echo $conu; ?>
                            ]
                        }, {
                            name: 'LEADs',
                            id: 'LEADs',
                            data: [<?php echo $ledu; ?>
                            ]
                        }]
                    }

                });
				
            });

</script>
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
			<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		</div>
	</div>
</section>
@stop