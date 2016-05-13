@extends('front/layout/clientfrontend_template')
@section('content')

<section class="dealer_request_area">
    <div class="container">
        <div class="row">
            
           <?php //dd($RequestQueue);?> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="brand-section">
                    <div class="container cli-req">
                        <div class="">
                        @foreach($RequestQueue as $rkey=>$Request)
                            <div class="col-xs-12 col-sm-4 col-md-4 carousel_area">
                                <div class="brand_request">
                                    <!-- Carousel ============ -->
                                <div id = "myCarousel{{$rkey}}" class = "carousel slide">
                                   
                                   <!-- Carousel indicators -->
                                    <ol class = "carousel-indicators">
                                    @if($Request->imx!="")
                                        @foreach($Request->imx as $vx=>$img)
                                        <li data-target = "#myCarousel{{$rkey}}" data-slide-to = "{{$vx}}" @if($vx==0)class = "active" @endif></li>
                                        @endforeach
                                    @else
                                        <li data-target = "#myCarousel{{$rkey}}" data-slide-to = "0" class = "active"></li>
                                    @endif
                                        
                                    </ol>   
                                   
                                   <!-- Carousel items -->
                                   <div class = "carousel-inner request-carousel-img">
                                    @if($Request->imx!="")
                                        @foreach($Request->imx as $vx=>$img)
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
                                   
                                   <!-- Carousel nav -->
                                    <a class = "carousel-control left" href = "#myCarousel{{$rkey}}" data-slide = "prev">&lsaquo;</a>
                                    <a class = "carousel-control right" href = "#myCarousel{{$rkey}}" data-slide = "next">&rsaquo;</a>
                                   
                                </div> <!-- /.carousel -->
                                    <!-- <img src="images/bmw.png" class="img-responsive" alt="Responsive image"> -->
                                    <h2>{{$Request->makes->name}}</h2>
                                    <div class="btns">
                                        <button type="button" class="btn btn-default c-p">{{$Request->models->name}}</button>
                                        <button type="button" class="btn btn-default c-p">{{$Request->year}}</button>
                                        <button type="button" class="btn btn-default c-p">OneTime :<?php $DoubleOneTime=floatval($Request->total_amount);echo "$".number_format($DoubleOneTime,2);?></button>
                                        <button type="button" class="btn btn-default c-p">Monthly :<?php $DoubleMonthly=floatval($Request->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></button>
                                    </div>
                                    <a href="{{url('/')}}/client/request_detail/{{base64_encode($Request->id)}}" class="btn-group">
                                        <button type="button" class="btn btn-success">OPEN</button>
                                        <button type="button" class="btn btn-warning">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>  <!-- /col-xs-12 col-md-4--> 
                        @endforeach   
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <!-- /row col-xs-12 select_option -->    
    </div><!--  /container --> 

    
</section> <!--  /dealer_request_area -->


@stop

