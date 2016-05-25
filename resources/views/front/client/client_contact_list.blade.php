@extends('front/layout/clientfrontend_template')
@section('content')

<section class="dealer_request_area">
    <div class="container">
        <div class="row">
            
           
           @if(empty($get_dealer_info))
            <div class="col-xs-6">
            <h3>No Contacts Found...</h3>
            </div>
            @else
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="brand-section">
                    <div class="container cli-req">
                        <div class="">
                            @foreach($get_dealer_info as $data)
                            <div class="col-xs-12 col-sm-4 col-md-4 carousel_area">
                                <div class="brand_request">
                                    <!-- Carousel ============ -->
                                <div id = "myCarousel" class = "carousel slide">
                                   
                                   <!-- Carousel indicators -->
                                    <ol class = "carousel-indicators">
                                        
                                        <li data-target = "#myCarousel" data-slide-to ="active" ></li>
                                        
                                        <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
                                        
                                        
                                    </ol>   
                                   
                                   <!-- Carousel items -->
                                   <div class = "carousel-inner request-carousel-img">
                                        
                                            <div class = "item active">
                                             <img src = "" alt = "x">
                                            </div>
                                      
                                        <div class = "item active">
                                        <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                                        </div>
                                       
                                   </div>
                                   
                                   <!-- Carousel nav -->
                                    <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
                                    <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
                                   
                                </div> <!-- /.carousel -->
                                    <!-- <img src="images/bmw.png" class="img-responsive" alt="Responsive image"> -->
                                    <h2> {{$data->dealership_name}}</h2>
                                    <div class="btns">
                                        <button type="button" class="btn btn-default c-p">{{$data->first_name}}</button>
                                        <button type="button" class="btn btn-default c-p">{{$data->last_name}}</button>
                                        <button type="button" class="btn btn-default c-p">{{$data->email}}</button>
                                    </div>
                                   <a href="#" class="btn-group">
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
            @endif
            
        </div> <!-- /row col-xs-12 select_option -->    
    </div><!--  /container --> 
</section> <!--  /dealer_request_area -->


@stop