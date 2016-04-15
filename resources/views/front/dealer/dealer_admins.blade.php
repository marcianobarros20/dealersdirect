@extends('front/layout/dealerfrontend_template')
@section('content')

<section class="selection_area">
     <div class="container">
      <h2 class="profile_head center-block"><?php echo Session::get('dealer_name');?> Your Admin List</h2>
       <div class="col-xs-12 next_button_area">
        <a href="{{url('/')}}/dealers/dealer_add_admin" type="button" class="btn btn-warning next_btn pull-right"> Add Admin</a>
       </div>
     </div><!--  /container -->
    </section>


    <section class="brand_section">
      <div class="container admin-cont">
        <div class="">
            
        @foreach ($Dealers as $Dealer)
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="brand_request admin-brand-req">
                @if(!empty($Dealer->dealer_details))
                    @if($Dealer->dealer_details->image!="")
                        <div class="img-set">
                            <img src="{{ url('/')}}/public/dealers/{{$Dealer->dealer_details->image}}" title="car" alt="car" />
                        </div>
                    @else
                        <div class="img-set">
                            <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                        </div>
                    @endif
                @else
                    <div class="img-set">
                        <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                    </div>
                @endif
                    
                    
                        <p><strong>Name:</strong>{!! $Dealer->first_name !!} {!! $Dealer->last_name !!}</p>
                        <p><strong>Email:</strong>{!! $Dealer->email !!} </p>
                        @if(!empty($Dealer->dealer_details))
                        <p><strong>Zip:</strong>{!! $Dealer->dealer_details->zip !!}</p>
                        <p><strong>Phone:</strong>{!! $Dealer->dealer_details->phone !!}</p>
                    
                    @endif
                      <div class="btn-group"  data-id="">
                       <button id="" type="button" class="btn btn-success">Delete</button>
                       <button type="button" class="btn btn-warning">
                        <i class="fa fa-long-arrow-right"></i>
                       </button>
                      </div>
                </div>
            </div>    <!-- /col-xs-12 col-md-4-->

            
        @endforeach
        
        @if(empty($Dealer))
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