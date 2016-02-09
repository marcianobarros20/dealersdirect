@extends('front/layout/dealerfrontend_template')
@section('content')
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
      <div class="">

          @foreach ($ReminderLead as $key => $Reminder)
            <div class="col-md-12">
                <div class="brand_request">
                      
                      <p><strong>Reminder Note:</strong>{{substr($Reminder->note,0,50).'...'}}</p>
                      <p><strong>Reminder Date:</strong>{!! date("dS M Y", strtotime($Reminder->rdate)) !!} </p>
                      <p><strong>Reminder Time:</strong>{!! date("h:i A", strtotime($Reminder->rtime))!!}</p>
                      <p><strong>lead Details:</strong>{!! $Reminder->lead_details->request_details->makes->name !!} {!! $Reminder->lead_details->request_details->models->name !!} {!! $Reminder->lead_details->request_details->year !!} {!! $Reminder->lead_details->request_details->condition !!}</p>
                      <a href="{{ url('/')}}/dealers/reminder/{{base64_encode($Reminder->id)}}"><button id="" type="submit" class="btn btn-success lead-btns"><i class="fa fa fa-eye"></i> View </button></a>
                        
                      
                </div>
              </div>
          @endforeach

          @if(!isset($ReminderLead))
            <div class="col-xs-12 col-md-4">
              <div class="brand_request">
              <h2>Sorry No Reminder List</h2>
              </div>
            </div>
          @endif



      </div>
    </div>
  </section>


@stop