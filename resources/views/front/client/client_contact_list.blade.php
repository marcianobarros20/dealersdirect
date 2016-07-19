@extends('front/layout/clientfrontend_template')
@section('content')

<section class="dealer_request_area car-contact-page">

    <!--new style --> 
        <div class="container  deal-make-lis">
        @if(empty($newarray))
            <div class="col-xs-6">
            <h3>No Contacts Found...</h3>
            </div>
            @else
            
        @foreach($leadssec as $data)

        <?php 
       //print_r($data);
       

       // foreach($secfun as $leadtypeskey => $leadTypesValue){

           // echo $leadTypesValue->lead_types."<br/>";

       // }
        //echo $data->lead_types;
        ?>

       
         <div class="row panel-row">
            <div class="col-lg-6 col-md-6 col-md-6">
                <div class="car-details">   
                    <div class="car-logo"><img height="54" width="112" src="<?php echo url('/');?>/public/dealers/{{$data->dealer_info->logo}}" alt="img"></div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Website :</strong></div>
                        <div class="col-md-9">{{$data->dealer_info->website_url}}</div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Name :</strong></div>
                        <div class="col-md-9">{{$data->dealer->first_name}} {{$data->dealer->last_name}}</div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Email ID :</strong></div>
                        <div class="col-md-9">{{$data->dealer_info->email_id}}
                        </div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Phone No :</strong></div>
                        <div class="col-md-9">{{$data->dealer_info->phone_no}}
                        </div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Address :</strong></div>
                        <div class="col-md-9">{{$data->dealer_info->contact_address}}
                        </div>
                    </div>
                    <div class="row car-info">
                        <div class="col-md-3"><strong>Details :</strong></div>
                        <div class="col-md-9">{{$data->dealer_info->details}}
                        </div>
                    </div>

                </div>  
            </div>
            
            
            <div class="col-lg-6 col-md-6 col-md-6">
                
                <div class="car-info-details">  
                <section class="autoplay slider">

            
              
              @foreach($newarray as $car_datas)

              
              @foreach($car_datas as $car_data)

             
              
              @if($data->dealer_info->dealer_id ==$car_data['dealer_id'])



               

              
                
                <div>
                  <div class="car-info-details-main">
                                   <div class="banner">
                                    @if(isset($car_data['carImagesFuel']->fuelImg_small_jpgformatlocal))
                                    <img src="{{ url('/')}}/public/fuelgallery/small/{{$car_data['carImagesFuel']->fuelImg_small_jpgformatlocal}}" alt="img">
                                    @else
                                    <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                                    @endif
                                    
                                </div>
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Car Name :</strong></div>
                                    <div class="col-md-8">{{$car_data['make']}}</div>
                                </div>  
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Model :</strong></div>
                                    <div class="col-md-8">{{$car_data['model']}}</div>
                                </div>
                                <div class="row car-info">      
                                    <div class="col-md-4"><strong>Year :</strong></div>
                                    <div class="col-md-8">{{$car_data['year']}}</div>
                                </div>
                                <div class="row car-info">
                                    <div class="col-md-12">
                                        
                                        <ul>
                                            <li>{{$car_data['condition']}}</li>
                                            <li><?php $DoubleMonthly=floatval($car_data['monthlyvalue']);echo "$".number_format($DoubleMonthly,2);?></li>
                                            <li><?php $DoubleTotal=floatval($car_data['totalvalue']);echo "$".number_format($DoubleTotal,2);?></li>

                                        </ul>  
                                        
                                        
                                    </div>
                                </div>
                                @if($car_data['lead_types']==0 || $car_data['lead_types']==1)
                                <div class="car-view"><a href="<?php echo URL::to('client/contact_details')?>/{{base64_encode($car_data['request_id'])}}/{{base64_encode($car_data['dealer_id'])}}"><img src="<?php echo url('/');?>/public/front_end/images/view.png" alt="img"></a></div>
                                @endif

                                @if($car_data['lead_types']==2)
                                <div><h2>Lost Lead</h2></div>
                                @endif
                                
                                @if($car_data['lead_types']==3)
                                <div><h2>Lost Sale</h2></div>
                                @endif

                                @if($car_data['lead_types']==4)
                                <div><h2>Success Sale</h2></div>
                                @endif
                        </div>  
                </div>
               

              
                @endif
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


