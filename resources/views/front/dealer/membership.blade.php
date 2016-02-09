@extends('front/layout/dealerfrontend_template')
@section('content')

<section>
                <div class="container deal-dash-cont">
                    
                    <div>
                    @if(Session::get('massage'))
            		<div class="alert alert-info col-xs-12" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('massage') }} 
                	<a href="#" class="close" data-dismiss="alert">×</a>
        		    </div>
		            @endif  
                    </div>
                    <h2 class="head center-block">Premium Membership </h2>
                    @if(empty($get_dealer_membership_info))
                    <div class="col-md-12">
                       
                        <div class="col-md-4 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L1Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level One </h1> 
                            </div>     
                        </div>

                        <div class="col-md-4 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L2Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level Two </h1> 
                            </div>     
                        </div>

                        <div class="col-md-4 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L3Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level Three </h1> 
                            </div>     
                        </div>  
                        
                    </div>

                    @elseif($get_dealer_membership_info->membership_type==1)
                    <div class="col-md-12">
                       
                        <div class="col-md-6 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L2Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level Two </h1> 
                            </div>     
                        </div>

                        <div class="col-md-6 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L3Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level Three </h1> 
                            </div>     
                        </div>  
                        
                    </div>
                    

                    @elseif($get_dealer_membership_info->membership_type==2)
                    <div class="col-md-8">
                                              
                        <div class="col-md-8 client_profile">
                            <div class="thumbnail">
                                <a href="#" data-toggle="modal" data-target="#L3Modal"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>Level Three </h1> 
                            </div>     
                        </div>  
                        
                    </div>
                    

                    @endif

                    

                </div>
            </section>

<!-- Modal L1 -->

  <div class="modal fade" id="L1Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Level 1 Membership</h4>
        </div>
        <div class="modal-body">
        <form action="{{route('membership')}}" method='post'>
        <input type='hidden' name='member_type' value='1'>
          <p>
          		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.

          </p>
          <button type="submit" class="btn-xs btn-success">Buy</button>
          <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>  
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal L1 Ends-->

<!-- Modal L2 -->

  <div class="modal fade" id="L2Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Level 2 Membership</h4>
        </div>
        <div class="modal-body">
        <form action="{{route('membership')}}" method='post'>
        <input type='hidden' name='member_type' value='2'>
          <p>
          		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.

          </p>
          <button type="submit" class="btn-xs btn-success">Buy</button>
          <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>  
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal L2 Ends-->

<!-- Modal L1 -->

  <div class="modal fade" id="L3Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Level 3 Membership</h4>
        </div>
        <div class="modal-body">
        <form action="{{route('membership')}}" method='post'>
        <input type='hidden' name='member_type' value='3'>
          <p>
          		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.

          </p>
          <button type="submit" class="btn-xs btn-success">Buy</button></a>
          <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>  
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal L1 Ends-->

@stop