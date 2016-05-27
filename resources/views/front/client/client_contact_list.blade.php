@extends('front/layout/clientfrontend_template')
@section('content')

<section class="dealer_request_area car-contact-page">

    <!--new style --> 
        <div class="container  deal-make-lis">
        @if(empty($get_dealer_info))
            <div class="col-xs-6">
            <h3>No Contacts Found...</h3>
            </div>
            @else
        @foreach($get_dealer_info as $data)
         <div class="row panel-row">
            <div class="col-lg-6 col-md-6 col-md-6">
                <div class="car-details">   
                    <div class="car-logo"><img src="<?php echo url('/');?>/public/front_end/images/car-logo.jpg" alt="img"></div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Website:</strong></div>
                        <div class="col-md-9">{{$data->dealership_name}}</div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Name:</strong></div>
                        <div class="col-md-9">{{$data->first_name}} {{$data->last_name}}</div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Contact:</strong></div>
                        <div class="col-md-9">{{$data->email}}
                        </div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Details:</strong></div>
                        <div class="col-md-9">Here goes the address. here goes the address. Here goes the address. here goes the address. Here goes the address. here goes the address
                        </div>
                    </div>

                </div>  
            </div>

            <div class="col-lg-6 col-md-6 col-md-6">
                
                <div class="car-info-details">  
                <section class="autoplay slider">

                @foreach($dealers_request_info as $value)
                
                
                @foreach($value['img'] as $img_data)
                <div>
                  <div class="car-info-details-main">
                                <div class="banner">
                                    <img src="{{ url('/')}}/public/edmunds/make/big/{{$img_data->local_path_big}}" alt="img">
                                    
                                </div>
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Car Name:</strong></div>
                                    <div class="col-md-8">{{$img_data->title}}</div>
                                </div>  
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Model:</strong></div>
                                    <div class="col-md-8">{{$value['request_queue_info']->models->name}}</div>
                                </div>
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Year:</strong></div>
                                    <div class="col-md-8">{{$img_data->year_id}}</div>
                                </div>
                                <div class="row car-info">
                                    <div class="col-md-12">
                                        
                                        <ul>
                                            <li>{{$value['request_queue_info']->condition}}</li>
                                            <li>{{$value['request_queue_info']->total_amount}}</li>
                                            <li>{{$value['request_queue_info']->monthly_amount}}</li>

                                        </ul>  
                                        
                                        
                                    </div>
                                </div>
                                <div class="car-view"><a href="#"><img src="<?php echo url('/');?>/public/front_end/images/view.png" alt="img"></a></div>
                        </div> 
                </div>
                @endforeach  

                @endforeach
                
                
                </section>


                </div>  <!-- car-info-details -->

                </div>
            </div>   
            @endforeach
            @endif

           
    </div>  
    <!-- new style end -->

</section> <!--  /dealer_request_area -->


<script src="<?php echo url('/');?>/public/front_end/css/slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
    });

    $('.autoplay').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 6000,
});
  </script>


@stop



