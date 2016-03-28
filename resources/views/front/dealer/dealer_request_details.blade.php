@extends('front/layout/dealer_template')
@section('content')
    <!-- ================================================== CAR SINGLE ================================================== -->
<input type="hidden" id="sortby" value="1">
<input type="hidden" id="pagestart" value="0">
<input type="hidden" id="pageend" value="2">
<input type="hidden" id="requestid" value="<?php echo base64_encode($requestqueuex['request_id']);?>">
    <section class="space-top-and-bottom medium">
        <div class="container">
            <div class="row">

                <!-- car single header -->
                <div class="car-single-header clearfix">

                    <div class="six columns alpha" data-appear-animation="slideInLeft">

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
                    <!-- sort by -->
                    <div class="two columns" data-appear-animation "slideInRight">
                        <div class="light-select-input sort-by">
                            <select id="shortoptions">
                                <option value="" >Sort By</option>
                                <option value="1" selected="selected">Best Pick</option>
                                <option value="2">Best Monthly</option>
                                <option value="3">Best Onetime</option>
                                
                            </select>
                        </div>
                    </div>
                    <!-- .sort by -->
                    <?php if($requestqueuex['blocked']==1){ ?>
                    <div data-appear-animation="slideInRight" class="four columns carell-animation slideInRight carell-animation-visible">
                        <div class="single-car-price">
                            <a class="button light medium" href=""><b> Blocked </b> </a>
                        </div>
                    </div>
                    <?php }else{ if($RequestQueue_row->status!=1){ ?>
                    <div data-appear-animation="slideInRight" class="four columns carell-animation slideInRight carell-animation-visible">
                        <div class="single-car-price">
                        <?php if($BidQueuecount==0){ ?>
                            <a class="button light medium dealpostbid" href="" data-id="<?php echo base64_encode($requestqueuex['id']);?>"><b>POST A BID</b> </a>
                        <?php }else{?>
                        <a class="button light medium dealstopbid" href="" data-id="<?php echo base64_encode($requestqueuex['id']);?>"><b>STOP BID</b> </a>
                        <a class="button light medium dealeditbid" href="" data-id="<?php echo base64_encode($requestqueuex['id']);?>"><b>EDIT YOUR BID</b> </a>
                        <?php } ?>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div data-appear-animation="slideInRight" class="four columns carell-animation slideInRight carell-animation-visible">
                        <div class="single-car-price">
                        
                            
                            <a class="button light medium" href=""><b>Bidding Closed</b> </a>
                        
                        </div>
                    </div>

                    <?php } }?>
                    

                </div>
                <!-- .car single header -->


                <!-- car single body -->
                <div class="car-single-body clearfix" data-appear-animation="slideInLeft">

                    <!-- car single media -->
                    <div class="eight columns alpha">
                        <?php if($EdmundsMakeModelYearImage!=""){ ?>
                        <div class="bannercontainer">
                            <div class="banner-single">

                                <ul>
                                <?php foreach ($EdmundsMakeModelYearImage as $key => $Image) {
                                   
                                ?>
                                    <li data-transition="fade" data-slotamount="<?php echo $key;?>">

                                    <?php if($requestqueuex['im_type']==1){ ?>
                                        <img src="{{ url('/')}}/public/edmunds/make/big/<?php echo $Image->local_path_big;?>" alt="" title="" />
                                    <?php }else{ ?>
                                        <img src="{{ url('/')}}/public/edmundsstyle/style/big/<?php echo $Image->local_path_big;?>" alt="" title="" />
                                    <?php } ?>
                                    </li>

                                <?php } ?>  

                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="comments" id="bidlist">
                            
                        </div>

                    </div>
                    <div id="test-popup" class="white-popup mfp-hide " data-effect="mfp-zoom-out">
                    <div class="bidhistory"></div>
                    
                                                        
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
                                    <li>USER INFO</li>
                                    @if(!empty($RequestQueue_row->trade_in))
                                    <li>Trade In</li>
                                    @endif
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
                                    @if(!empty($RequestQueue_row->trade_in))
                                        <div>
                                            <div>
                                                <ul class="tab-list">
                                                    <li>Make:
                                                        <span> <b>{{$RequestQueue_row->trade_ins->makes->name}}</b> 
                                                        </span>
                                                    </li>
                                                    <li>Model:
                                                        <span> <b>{{$RequestQueue_row->trade_ins->models->name}}</b> 
                                                        </span>
                                                    </li>
                                                    <li>Year:
                                                        <span> <b>{{$RequestQueue_row->trade_ins->year}}</b> 
                                                        </span>
                                                    </li>
                                                    <li>Conditions:
                                                        <span> <b>{{$RequestQueue_row->trade_ins->condition}}</b> 
                                                        </span>
                                                    </li>
                                                    @if($RequestQueue_row->trade_ins->owe==1)
                                                    <li>OWE Amount:
                                                        <span> <b>{{$RequestQueue_row->trade_ins->owe_amount}}</b> 
                                                        </span>
                                                    </li>
                                                    @endif
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    
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