@extends('front/layout/dealer_template')
@section('content')
		
   <!-- ================================================== PAGINATION ================================================== -->

    <section>
        <div class="container">
            
            <div class="row">

            <?php foreach ($requestqueuex as $key => $value) {
            ?>
               

                <div class="three columns">
                    <div class="car-box vertical medium">

                        <!-- image -->
                        <div class="car-image">
                            <a href="#">
                                <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                                <span class="background">
                                    <span class="icon-plus"></span>
                                </span>
                            </a>
                        </div>
                        <!-- .image -->

                        <!-- content -->
                        <div class="car-content">

                            <!-- title -->
                            <div class="car-title">
                                <h3><a href="#"><?php echo $value['make'];?></a>
                                </h3>
                            </div>
                            <!-- .title -->

                            <!-- tags -->
                            <div class="car-tags">
                                <ul class="clearfix">
                                    <li><?php echo $value['year'];?></li>
                                    <li><?php echo $value['model'];?></li>
                                    <li><?php echo $value['conditions'];?></li>
                                    
                                </ul>
                            </div>
                            <!-- .tags -->

                            <!-- price -->
                            <div class="car-price">
                                <a href="<?php echo url('/');?>/dealers/request_detail/<?php echo base64_encode($value['id']);?>" class="clearfix">
                                    <span class="price"><?php if($value['status']==1){echo "Closed";}else{echo "Open";}?></span>
                                    <span class="icon-arrow-right2"></span>
                                </a>
                            </div>
                            <!-- .price -->

                        </div>
                        <!-- .content -->

                    </div>
                </div>
                

            <?php }
            ?>
               

            </div>
            <!-- .1 -->

            

        </div>


        </div>
        </div>
    </section>

    <!-- ================================================== END PAGINATION ============================================== -->


@stop