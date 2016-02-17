@extends('front/layout/dealer_template')
@section('content')
		
    <!-- ================================================== TESTIMONIALS ================================================== -->
    <section class="space-top-and-bottom medium">
        <div class="container">

            <!-- heading -->
            <div class="row">
                <div class="twelve columns" data-appear-animation="bounceIn">
                    <div class="heading">
                        <h1><b>Welcome</b> <?php echo Session::get('dealer_name');?> To Your <b>Dashboard</b></h1>
                        <span></span>
                    </div>
                </div>
            </div>
            <!-- .heading -->

            <!-- about content -->
            <div class="row space-top small">
                <div class="four columns alpha" data-appear-animation="slideInLeft">
                    <div class="promo-box round unboxed transparent">

                        <!-- promo number -->
                        <div class="promo-number">
                            <p>
                                <a href="<?php echo url('/');?>/dealer/dealer_make"><span class="icon-hammer"></span></a>
                            </p>
                        </div>
                        <!-- .promo number -->

                        <!-- promo content -->
                        <div class="promo-content">
                            <a href="<?php echo url('/');?>/dealer/dealer_make"><h4>Makes</h4></a>
                        </div>
                        <!-- promo content -->

                    </div>
                </div>
                <div class="four columns" data-appear-animation="bounceIn">
                    <div class="promo-box unboxed round transparent">

                        <!-- promo number -->
                        <div class="promo-number">
                            <p>
                                <a href="<?php echo url('/');?>/dealer/profile"><span class="icon-profile"></span></a>
                            </p>
                        </div>
                        <!-- .promo number -->

                        <!-- promo content -->
                        <div class="promo-content">
                            <a href="<?php echo url('/');?>/dealer/profile"><h4>Profile</h4></a>
                        </div>
                        <!-- promo content -->

                    </div>
                </div>
                <div class="four columns" data-appear-animation="bounceIn">
                    <a href="#">
                        <div class="promo-box round unboxed transparent">

                            <!-- promo number -->
                            <div class="promo-number">
                                <p>
                                    <a href="<?php echo url('/');?>/dealers/request_list"><span class="icon-list"></span></a>
                                </p>
                            </div>
                            <!-- .promo number -->

                            <!-- promo content -->
                            <div class="promo-content">
                                <a href="<?php echo url('/');?>/dealers/request_list"><h4>Request List</h4></a>
                            </div>
                            <!-- promo content -->

                        </div>
                    </a>
                </div>

                
            </div>
            <!-- .about content -->

            

            

        </div>
    </section>

    <!-- ================================================== END TESTIMONIALS ================================================== -->

@stop