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
                            <?php $keys=0;
                            foreach ($Bidqueue->bid_image as $key => $bid_image){
                                
                                if($bid_image->dealer_id==$Bidqueue->dealer_id){
                                     $keys++;
                            ?>
                                <img src="<?php echo url('/');?>/public/uploads/project/thumb/{!! $bid_image->image!!}" title="car" alt="car" />
                            <?php
                             }
                             } if( $keys==0){?>
                             <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                             <?php }?> 
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
                                    <li><strong>Monthly:</strong><?php $DoubleMonthly=floatval($Bidqueue->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></li>
                                    <li><strong>Total{!! $Bidqueue->id !!}:</strong><?php $DoubleTotal=floatval($Bidqueue->total_amount);echo "$".number_format($DoubleTotal,2);?></li>
                                    <?php if($Bidqueue->status==3){?>
                                    <li class="label success"><strong> Accepted  </li>
                                    <?php }?>
                                    @if($Bidqueue->trade_in!=0)
                                    <li><strong>Trade In:</strong><?php $DoubleTrade_in=floatval($Bidqueue->trade_in);echo "$".number_format($DoubleTrade_in,2);?></li>
                                    @endif
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