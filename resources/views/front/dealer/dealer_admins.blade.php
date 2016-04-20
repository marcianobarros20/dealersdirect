@extends('front/layout/dealerfrontend_template')
@section('content')

<section class="selection_area">
     <div class="container">
      <h2 class="profile_head center-block"><?php echo Session::get('dealer_name');?> Your Admin List</h2>

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
          <div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('error') }} 
            <a href="#" class="close" data-dismiss="alert">×</a>
          </div>
        <div class="col-xs-4"></div>
        @endif

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
                            <img src="{{ url('/')}}/public/front/images/car-1.jpg" title="car" alt="car" />
                        </div>
                    @endif
                @else
                    <div class="img-set">
                        <img src="{{ url('/')}}/public/front/images/car-1.jpg" title="car" alt="car" />
                    </div>
                @endif
                    
                    
                        <p><strong>Name:</strong>{!! $Dealer->first_name !!} {!! $Dealer->last_name !!}</p>
                        <p><strong>Email:</strong>{!! $Dealer->email !!} </p>
                        @if(!empty($Dealer->dealer_details))
                        <p><strong>Zip:</strong>{!! $Dealer->dealer_details->zip !!}</p>
                        <p><strong>Phone:</strong>{!! $Dealer->dealer_details->phone !!}</p>
                    
                    @endif
                      <a href="{{ route('dealer.admins.edit', ['admin_id' => $Dealer->id]) }}" class="btn-group"  data-id="" >
                       <button id="" type="submit" class="btn btn-success">Edit</button>
                       <button type="submit" class="btn btn-warning">
                        <i class="fa fa-long-arrow-right"></i>
                       </button>
                      </a>
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