@extends('front/layout/dealer_template')
@section('content')
    <!-- ================================================== CAR SINGLE ================================================== -->

    <section class="space-top-and-bottom medium">
        <div class="container">
            <div class="row">

                <!-- car single header -->
                <div class="car-single-header clearfix">

                    <div class="ten columns alpha" data-appear-animation="slideInLeft">

                        <!-- date added -->
                        <div class="single-car-date-added">
                            <p>
                                <span class="icon-calendar"></span><?php echo $requestqueuex['cat'];?></p>
                        </div>
                        <!-- date added -->

                        <!-- car title -->
                        <div class="single-car-title">
                            <h3><?php echo $requestqueuex['make'];?></h3>
                        </div>
                        <!-- .car title -->

                    </div>


                    

                </div>
                <!-- .car single header -->


                <!-- car single body -->
                <div class="car-single-body clearfix" data-appear-animation="slideInLeft">

                    <!-- car single media -->
                    <div class="eight columns alpha">

                        <div class="bannercontainer">
                            <div class="banner-single">

                                <ul>

                                    <li data-transition="fade" data-slotamount="1">

                                        <img src="<?php echo url('/');?>/public/front/images/slide1.png" alt="" title="" />

                                    </li>

                                    <li data-transition="fade" data-slotamount="1">

                                        <img src="<?php echo url('/');?>/public/front/images/slide2.png" alt="" title="" />

                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- .car single media -->


                    <!-- car single info -->
                    <div class="four columns" data-appear-animation="slideInRight">

                        <div class="horizontal-tab clearfix">
                            <div class="h-tab">
                                <ul class="resp-tabs-list clearfix">
                                    <li>DETAILS</li>
                                    <li>USER INFO</li>
                                    
                                </ul>

                                <div class="resp-tabs-container">

                                    <div>
                                         <div>
                                        <ul class="tab-list">
                                            <li>Make:
                                                <span> <b><?php echo $requestqueuex['make'];?></b> 
                                                </span>
                                            </li>
                                            <li>Model:
                                                <span> <b><?php echo $requestqueuex['model'];?></b> 
                                                </span>
                                            </li>
                                            <li>Year:
                                                <span> <b><?php echo $requestqueuex['year'];?></b> 
                                                </span>
                                            </li>
                                            <li>Conditions:
                                                <span> <b><?php echo $requestqueuex['conditions'];?></b> 
                                                </span>
                                            </li>
                                            
                                            <li>Total Amount:
                                                <span> <b><?php echo $requestqueuex['total'];?></b> 
                                                </span>
                                            </li>
                                            <li>Monthly Amount:
                                                <span> <b><?php echo $requestqueuex['monthly'];?></b> 
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>

                                    <div>
                                       <div>
                                        <ul class="tab-list">
                                            <li>User Name:
                                                <span> <b><?php echo $requestqueuex['cfname'];?> <?php echo $requestqueuex['lem'];?></b> 
                                                </span>
                                            </li>
                                            <li>User Email:
                                                <span> <b><?php echo $requestqueuex['cemail'];?></b> 
                                                </span>
                                            </li>
                                            <li>User Phone:
                                                <span> <b><?php echo $requestqueuex['cphone'];?></b> 
                                                </span>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    </div>

                                    
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- .car single info -->

                    

                </div>
                <!--. car single body -->


            </div>
        </div>
    </section>

    <!-- ================================================== CAR SINGLE ============================================== -->

@stop