@extends('front/layout/dealerfrontend_template')
@section('content')
            <section>
                <div class="container deal-dash-cont">
                    <h2 class="head center-block">WELCOME 
                        @if(Session::get('dealer_parent')==0)
                            Super Admin 
                        @else
                            Admin
                        @endif
                            {{ Session::get('dealer_name') }} TO YOUR DASHBOARD
                    </h2>
                    <div class="">
                        <div class="col-xs-12 col-sm-3 col-md-3 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/dealer/dealer_make"><img src="<?php echo url('/');?>/public/front_end/images/make_icon.png" alt="image"></a>
                                <h1>MAKE</h1> 
                            </div>     
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->
                        @if(Session::get('dealer_parent')==0)
                        <div class="col-xs-12 col-sm-3 col-md-3 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/dealer/admins"><img src="<?php echo url('/');?>/public/front_end/images/profile_icon.png" alt="image"></a>
                                <h1>ADMIN</h1>
                            </div>
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->
                        @endif
                        <div class="col-xs-12 col-sm-3 col-md-3 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/dealer/profile"><img src="<?php echo url('/');?>/public/front_end/images/pic1.png" alt="image"></a>
                                <h1>PROFILES</h1> 
                            </div>     
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->
                        <div class="col-xs-12 col-sm-3 col-md-3 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/dealers/request_list"><img src="<?php echo url('/');?>/public/front_end/images/request_icon.png" alt="image"></a>
                                <h1>REQUEST</h1> 
                            </div>     
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->   
                    </div>
                </div>
            </section>
		
    <!-- ================================================== TESTIMONIALS ================================================== -->
    

    <!-- ================================================== END TESTIMONIALS ================================================== -->

@stop