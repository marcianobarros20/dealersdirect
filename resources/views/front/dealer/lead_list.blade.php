@extends('front/layout/dealerfrontend_template')
@section('content')

  <section class="selection_area">
        <div class="container">
            <h2 class="profile_head center-block"><?php echo Session::get('dealer_name');?> Your Lead List</h2>

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
      <div class="">

          @foreach ($LeadContact as $key => $Lead)
            <div class="col-md-12">
                <div class="brand_request">
                      <div id = "myCarousel{{$key}}" class = "carousel slide">


                      <ol class = "carousel-indicators">
                      @if(!empty($Lead->imx))
                      @foreach($Lead->imx as $vx=>$img)
                      <li data-target = "#myCarousel{{$key}}" data-slide-to = "{{$vx}}" @if($vx==0)class = "active"@endif></li>
                      @endforeach
                      @else
                      <li data-target = "#myCarousel{{$key}}" data-slide-to = "0" class = "active"></li>
                      @endif
                      </ol>   


                      <div class = "carousel-inner">
                      @if(!empty($Lead->imx))
                      @foreach($Lead->imx as $vx=>$img)
                      <div class = "item @if($vx==0) active @endif">
                      <img src = "{{ url('/')}}/public/edmunds/make/big/{{$img->local_path_big}}" alt = "x">
                      </div>
                      @endforeach 
                      @else
                      <div class = "item active">
                      <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                      </div>
                      @endif 
                      </div>


                      <a class = "carousel-control left" href = "#myCarousel{{$key}}" data-slide = "prev">&lsaquo;</a>
                      <a class = "carousel-control right" href = "#myCarousel{{$key}}" data-slide = "next">&rsaquo;</a>
                      </div>
                      <p><strong>Make:</strong>{!! $Lead->request_details->makes->name !!}</p>
                      <p><strong>Model:</strong>{!! $Lead->request_details->models->name !!} </p>
                      <p><strong>Year:</strong>{!! $Lead->request_details->year !!}</p>
                      <p><strong>Conditions:</strong>{!! $Lead->request_details->condition !!}</p>
                      <p><strong>Lead Status:</strong>
                      @if($Lead->lead_types==0)
                      COLD LEAD
                      @elseif($Lead->lead_types==1)
                      HOT LEAD
                      @elseif($Lead->lead_types==2)
                      LOST LEAD
                      @elseif($Lead->lead_types==3)
                      LOST SALE
                      @elseif($Lead->lead_types==4)
                      SUCCESS SALE
                      @else
                      NO STATUS
                      @endif
                      </p>
                        <button id=""  data-toggle="modal" data-target="#ContactModal" type="submit" data-inox="{{base64_encode($Lead->id)}}" class="btn btn-primary client_contact lead-btns"><i class="fa fa fa-phone"></i> Contact Information</button> 
                        <button id=""  data-toggle="modal" data-target="#myModal" type="submit" data-inox="{{base64_encode($Lead->id)}}" class="btn btn-primary remindbox lead-btns"><i class="fa fa fa-bell"></i> Reminder</button>
                        @if($Lead->lead_types!=0)
                        <button id="" type="submit" class="btn btn-success lead_cold lead-btns" data-inox="{{base64_encode($Lead->id)}}"><i class="fa fa fa-cubes"></i> Cold Lead</button>
                        @endif
                        @if($Lead->lead_types!=1)
                        <button id="" type="submit" class="btn btn-info lead_hot lead-btns" data-inox="{{base64_encode($Lead->id)}}"><i class="fa fa fa-fire"></i> Hot Lead</button>
                        @endif
                        @if($Lead->lead_types!=2)
                        <button id="" type="submit" class="btn btn-warning lead_lost lead-btns" data-inox="{{base64_encode($Lead->id)}}"><i class="fa fa-ban"></i> Lost Lead</button>
                        @endif
                        @if($Lead->lead_types!=3)
                        <button id="" type="submit" class="btn btn-danger lost_sale lead-btns" data-inox="{{base64_encode($Lead->id)}}"><i class="fa fa-times lead_lost_sale"></i> Lost SALE</button>
                        @endif
                        @if($Lead->lead_types!=4)
                        <button id="" type="submit" class="btn btn-secondary lead_success_sale lead-btns" data-inox="{{base64_encode($Lead->id)}}"><i class="fa fa-check-square "></i> Success SALE</button>
                        @endif
                        
                      
                </div>
              </div>
          @endforeach

          @if(!isset($LeadContact))
            <div class="col-xs-12 col-md-4">
              <div class="brand_request">
              <h2>Sorry No Lead List</h2>
              </div>
            </div>
          @endif



      </div>
    </div>
  </section>
		
    
<!-- modal fade -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SET REMINDER</h4>
        </div>
        <div class="modal-body">
                        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
          Close</button>
          
        </div>
      </div>
    </div>
</div>
<!-- ./modal fade -->


<!-- Client Contact modal -->
<div class="modal fade" id="ContactModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Client Contact Information</h4>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
          Close</button>
          
        </div>
      </div>
    </div>
</div>
<!-- ./Client Contact modal -->


@stop