<?php
        $i=0;
        $start=0; 
        $end=0;
        foreach ($BidQueue as $key => $Bidqueue) { 
            if($i==0){ $start++;?>
            <div class="row">
            <?php } ?>

            <div class="five columns">
                    <div class="car-box horizontal small clearfix">

                        <!-- image -->
                        <div class="car-image">
                            <a href="#">
                                <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                                
                            </a>
                        </div>
                        <!-- .image -->

                        <!-- content -->
                        <div class="car-content">

                            <!-- title -->
                            <div class="car-title">
                                <h3><a href="#">{!! $Bidqueue->dealers->first_name!!} {!! $Bidqueue->dealers->last_name!!}</a>
                                </h3>
                            </div>
                            <!-- .title -->
                            <div class="car-tags">
                                <ul class="clearfix">
                                    <li><strong>Monthly:</strong>{!! $Bidqueue->monthly_amount !!}</li>
                                    <li><strong>Total{!! $Bidqueue->id !!}:</strong>{!! $Bidqueue->total_amount !!}</li>
                                    
                                </ul>
                            </div>
                            <!-- price -->
                            <div class="car-price">
                                <a data-effect="mfp-zoom-out" data-bid="{!! $Bidqueue->id !!}"class="popup-modal" href="#test-popup" >
                                    <span class="price">View</span>
                                    <span class="icon-arrow-right2"></span>
                                </a>
                            </div>
                            <!-- .price -->

                        </div>
                        <!-- .content -->

                    </div>
                </div>
                <!-- .car small -->
                            
<?php               if($i==1){
                    $end++;
                    ?></div><?php
                    $i=0;
                    }else{
                    $i++;
                    }
        } 
            if($start!=$end){?></div><?php }
?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/cross.js"></script> 