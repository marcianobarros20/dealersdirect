@extends('front/layout/client_template')
@section('content')
    <!-- ================================================== CAR SINGLE ================================================== -->

    <section class="space-top-and-bottom medium">
        <div class="container">
            <div class="row">

                <!-- car single header -->
                <div class="car-single-header clearfix">

                    <div class="eight columns alpha" data-appear-animation="slideInLeft">

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
                    <div data-appear-animation="slideInRight" class="four columns carell-animation slideInRight carell-animation-visible">
                        <div class="single-car-price">
                            <a class="button light medium" href="<?php echo url('/');?>/client/add-style/<?php echo base64_encode($requestqueuex['id']);?>"><b>Add MORE DETAILS</b> </a>
                        </div>
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
                                    <?php foreach ($RequestStyleEngineTransmissionColor as $key => $value) { ?>
                                    <li>OPTIONS {!! $key+1 !!}</li>
                                    <?php } ?>
                                    
                                    
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
                                    <?php foreach ($RequestStyleEngineTransmissionColor as $key => $value) { ?>
                                    
                                    <div>
                                       <div>
                                        <ul class="tab-list">
                                            <li><b>Style Name :</b> {!!  $value->styles->name !!}
                                            </li>
                                            <li><b>Body :</b> {!!  $value->styles->body !!}
                                            </li>
                                            <li><b>Style Name :</b> {!!  $value->styles->name !!}
                                            </li>
                                            <li><b>Compression Ratio :</b> {!!  $value->engines['compressionRatio'] !!}</li>
                                            <li><b>Cylinder :</b> {!!  $value->engines['cylinder'] !!}</li>
                                            <li><b>Size :</b> {!!  $value->engines['size'] !!}</li>
                                            <li><b>Displacement :</b> {!!  $value->engines['displacement'] !!}</li>
                                            <li><b>Configuration :</b> {!!  $value->engines['configuration'] !!}</li>
                                            <li><b>Fuel Type :</b> {!!  $value->engines['fuelType'] !!}</li>
                                            <li><b>Horsepower :</b> {!!  $value->engines['horsepower'] !!}</li>
                                            <li><b>Torque :</b> {!!  $value->engines['torque'] !!}</li>
                                            <li><b>Total Valves :</b> {!!  $value->engines['totalValves'] !!}</li>
                                            <li><b>Type :</b> {!!  $value->engines['type'] !!}</li>
                                            <li><b>Code :</b> {!!  $value->engines['code'] !!}</li>
                                            <li><b>Compressor Type :</b> {!!  $value->engines['compressorType'] !!}</li>
                                            <?php if(!empty($value->engines['rpm'])){foreach (json_decode($value->engines['rpm'],true) as $key => $rpm) { ?>
                                           <li><b>RPM ({!! $key !!}):</b> {!!  $rpm !!}</li>
                                            <?php }} ?>
                                            <?php if(!empty($value->engines['valve'])){foreach (json_decode($value->engines['valve'],true) as $keyv => $valve) { ?>
                                            <li><b>Valve ({!! $keyv !!}):</b> {!!  $valve !!}</li>
                                            <?php }} ?>
                                            
                                        </ul>
                                    </div>
                                    </div>

                                    <?php } ?>
                                    
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