@extends('front/layout/dealerfrontend_template')
@section('content')

  <section class="selection_area">
        <div class="container">
            <h2 class="profile_head center-block"><?php echo Session::get('dealer_name');?> Contact Your List</h2>

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

  @foreach ($ContactList as $key => $Contact)
    <div class="col-xs-12 col-md-4">
        <div class="brand_request">
              <div id = "myCarousel{{$key}}" class = "carousel slide">


              <ol class = "carousel-indicators">
              @if(!empty($Contact->imx))
              @foreach($Contact->imx as $vx=>$img)
              <li data-target = "#myCarousel{{$key}}" data-slide-to = "{{$vx}}" @if($vx==0)class = "active"@endif></li>
              @endforeach
              @else
              <li data-target = "#myCarousel{{$key}}" data-slide-to = "0" class = "active"></li>
              @endif
              </ol>   


              <div class = "carousel-inner">
              @if(!empty($Contact->imx))
              @foreach($Contact->imx as $vx=>$img)
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


              <a class = "carousel-control left" href = "#myCarousel{{$key}}" data-slide = "prev">&lsaquo;</a>
              <a class = "carousel-control right" href = "#myCarousel{{$key}}" data-slide = "next">&rsaquo;</a>
              </div>
              <p><strong>Make:</strong>{!! $Contact->request_details->makes->name !!}</p>
              <p><strong>Model:</strong>{!! $Contact->request_details->models->name !!} </p>
              <p><strong>Year:</strong>{!! $Contact->request_details->year !!}</p>
              <p><strong>Conditions:</strong>{!! $Contact->request_details->condition !!}</p>
              @if($Contact->payment_status==1)
              <p><strong>Status:</strong>Purchased</p>
              @endif
              <a href="{{ route('dealer.contact.details', ['contact_id' => $Contact->id]) }}" class="btn-group"  data-id="" >
                <button id="" type="submit" class="btn btn-success">View</button>
                <button type="submit" class="btn btn-warning">
                <i class="fa fa-long-arrow-right"></i>
                </button>
              </a>
        </div>
      </div>
  @endforeach

    @if(empty($ContactList))
      <div class="col-xs-12 col-md-4">
        <div class="brand_request">
        <h2>Sorry No Admin List</h2>
        </div>
      </div>
    @endif



  </div>
  </div>
  </section>
		
    

@stop