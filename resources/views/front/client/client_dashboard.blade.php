@extends('front/layout/clientfrontend_template')
@section('content')
<section>
                <div class="container">
                    <h2 class="head center-block">WELCOME {{Session::get('client_name')}} TO YOUR DASHBOARD</h2>
                    <div class="">
                        <div class="col-xs-12 col-sm-6 col-md-6 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/client/request_list"><img src="<?php echo url('/');?>/public/front_end/images/pic2.png" alt="image"></a>
                                <h1>REQUEST</h1>
                            </div>
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->   

                        <div class="col-xs-12 col-sm-6 col-md-6 client_profile">
                            <div class="thumbnail">
                                <a href="<?php echo url('/');?>/client/contact_list"><img src="<?php echo url('/');?>/public/front_end/images/pic1.png" alt="image"></a>
                                <h1>CONTACTS</h1> 
                            </div>     
                        </div> <!-- /col-xs-12 col-sm-6 col-md-6 -->
                        
                    </div>
                </div>
            </section>

@stop