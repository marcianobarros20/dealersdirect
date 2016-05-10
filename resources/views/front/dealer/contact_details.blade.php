@extends('front/layout/dealerfrontend_request_template')
@section('content')

<section>
	<div class="container request-client-cont">
		<div class="row detail-text">
			<div class="col-md-4">
			    
				<h2>Detail</h2>
			</div>
			
	 	</div>
	 
		
		<div class="post-bid">
			<div class="col-xs-12 col-sm-8 col-md-8"> <!-- edited on 13-04-2016 -->
			    <!-- Carousel ============ -->
				<div id = "myCarousel" class = "carousel slide deal-caro">
				   
				   <!-- Carousel indicators -->
					<ol class = "carousel-indicators">
						@if(!empty($ContactDetail->imx))
							@foreach($ContactDetail->imx as $vx=>$img)
								<li data-target = "#myCarousel" data-slide-to = "{{$vx}}" @if($vx==0)class = "active"@endif></li>
							@endforeach
						@else
							<li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
						@endif
					</ol>  
				   
					<div class = "carousel-inner client-caro-img">
						@if(!empty($ContactDetail->imx))
							@foreach($ContactDetail->imx as $vx=>$img)
								<div class = "item @if($vx==0) active @endif">
									<img src = "{{ url('/')}}/public/edmunds/make/small/{{$img->local_path_smalll}}" alt = "x">
								</div>
							@endforeach 
						@else
							<div class = "item active">
							<img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
							</div>
						@endif 
					</div>


              <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
              <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
              </div>
					
				<div class="brand-sec  bidlist">
					<div class="col-xs-12 col-sm-12 col-md-12  carousel_area">
						<div  class="brand_request" style="background-color:#fff0e6;">
							<div class="row img-area">
								<div class="col-xs-12 col-sm-12 col-md-6 image-view">
									<img src="images/pic1.jpg" class="img-responsive" alt="Responsive image">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 image-view">
									<img src="images/pic2.jpg" class="img-responsive" alt="Responsive image">
								</div>
							</div>
							<h2>Acura GG</h2>
							<div class="btns">
								<button type="button" class="btn btn-default c-p-b">Monthly 675</button>
								<button type="button" class="btn btn-default c-p-b">67500</button>
								<button type="button" class="btn btn-default c-p-b">OneTime:3000</button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-success">View</button>
								<button type="button" class="btn btn-warning">
									<i class="fa fa-long-arrow-right"></i>
								</button>
							</div>
						</div>
					</div>	<!-- /col-xs-12 col-md-4-->
					
				</div>
			</div>	<!-- /col-xs-8 -->
			<div class="col-xs-12 col-sm-4 col-md-4"> <!-- edited on 13-04-2016 -->
				
					<div id="content">
			        <ul id="tabs" class="nav nav-tabs profile-browse postbid-browse" data-tabs="tabs">
				        <li class="active"><a href="#requestdetail" data-toggle="tab">Details</a></li>
                        @if(!empty($ContactDetail->request_details->trade_ins) && $ContactDetail->request_details->trade_ins->make_id!=0)
                        <li ><a href="#tradein" data-toggle="tab">Trade-In</a></li>
                        @endif
                        
                        @if(!empty($ContactDetail->request_details->options))
                            @foreach($ContactDetail->request_details->options as $optionkey=>$option)
                                <li><a href="#options{{$optionkey+1}}" data-toggle="tab">Option{{$optionkey+1}}</a></li>
                            @endforeach
                        @endif
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="requestdetail">
                            <table class="table client-table"> 
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>MAKE:</td> 
                                        <td>{{$ContactDetail->request_details->makes->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MODEL:</td> 
                                        <td>{{$ContactDetail->request_details->models->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>YEAR:</td> 
                                        <td>{{$ContactDetail->request_details->year}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>CONDITION:</td> 
                                        <td>{{$ContactDetail->request_details->condition}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>TOTAL AMOUNT:</td> 
                                        <td>{{$ContactDetail->request_details->total_amount}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MONTHLY AMOUNT:</td> 
                                        <td>{{$ContactDetail->request_details->monthly_amount}}</td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </div>
				        @if(!empty($ContactDetail->request_details->trade_ins)&& $ContactDetail->request_details->trade_ins->make_id!=0)
                            <div class="tab-pane form-head" id="tradein">
                                <table class="table client-table"> 
                                    <tbody class="post-text"> 
                                        <tr> 
                                            <td>Trade-IN MAKE:</td> 
                                            <td>{{$ContactDetail->request_details->trade_ins->makes->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN MODEL:</td> 
                                            <td>{{$ContactDetail->request_details->trade_ins->models->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN CONDITIONS:</td> 
                                            <td>{{$ContactDetail->request_details->trade_ins->condition}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN YEAR:</td> 
                                            <td>{{$ContactDetail->request_details->trade_ins->year}}</td> 
                                        </tr> 
                                        @if($ContactDetail->request_details->trade_ins->owe==1)
                                        <tr> 
                                            <td>Trade-IN OWE Amount:</td> 
                                            <td>{{$ContactDetail->request_details->trade_ins->owe_amount}}</td> 
                                        </tr> 
                                        @endif
                                    </tbody> 
                                </table>
                            </div>
                        @endif
                        @if(!empty($ContactDetail->request_details->options))
                            @foreach($ContactDetail->request_details->options as $optionkey=>$option)
                                <div class="tab-pane form-head" id="options{{$optionkey+1}}">
                                    <table class="table client-table"> 
                                        <tbody class="post-text">
                                            @if(!empty($option->styles->price))
                                                @foreach (json_decode($option->styles->price,true) as $key => $price)
                                                    @if($key=="baseMSRP")
                                                        <tr> 
                                                            <td>{{$key}}:</td> 
                                                            <td>{{$price}}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <tr> 
                                                <td>Style Name:</td> 
                                                <td>{{$option->styles->name}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Body:</td> 
                                                <td>{{$option->styles->body}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Compression Ratio:</td> 
                                                <td>{{$option->engines['compressionRatio']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Cylinder:</td> 
                                                <td>{{$option->engines['cylinder']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Displacement:</td> 
                                                <td>{{$option->engines['displacement']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Configuration:</td> 
                                                <td>{{$option->engines['configuration']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Fuel Type:</td> 
                                                <td>{{$option->engines['fuelType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Torque:</td> 
                                                <td>{{$option->engines['torque']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Total Valves:</td> 
                                                <td>{{$option->engines['totalValves']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Code:</td> 
                                                <td>{{$option->engines['code']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type:</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type:</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            @if(!empty($option->engines['rpm']))
                                                @foreach (json_decode($option->engines['rpm'],true) as $key => $rpm)
                                                <tr> 
                                                    <td>RPM ({{ $key }}):</td> 
                                                    <td>{{  $rpm }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->engines['valve']))
                                                @foreach (json_decode($option->engines['valve'],true) as $keyv => $valve)
                                                <tr> 
                                                    <td>Valve ({{ $keyv }}):</td> 
                                                    <td>{{  $valve }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->excolor))
                                                <tr> 
                                                    <td>Exterior Color:</td> 
                                                    <td>
                                                        {{$option->excolor['name']}}
                                                        @if($option->excolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->excolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                            @if(!empty($option->incolor))
                                                <tr> 
                                                    <td>Interior Color:</td> 
                                                    <td>
                                                        {{$option->incolor['name']}}
                                                        @if($option->incolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->incolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                        </tbody> 
                                    </table>
                                </div>
                            @endforeach
                        @endif
			        </div>
		        </div>
			</div>	<!-- /col-xs-4 -->
		</div>
	</div>
</section>
@stop