@extends('front/layout/dealer_template')
@section('content')
		
    <!-- ================================================== Home Listing ================================================== -->

    <section>
        <div class="container">
        <div class="row ">

                <!-- Home Single header -->
                <div class="home-single-header clearfix">

                    <div class="ten columns alpha" data-appear-animation="slideInLeft">

                        

                        <!-- car title -->
                        <div class="single-car-title">
                            <h3><?php echo Session::get('dealer_name');?> Your Make List</h3>
                        </div>
                        <!-- .car title -->

                    </div>


                    <!-- car price -->
                    <div class="two columns" data-appear-animation="slideInRight">
                        <div class="single-car-price clearfix">
                            <a href="<?php echo url('/');?>/dealers/dealer_add_make" class="button light medium"><b>Add Make</b></a>
                        </div>
                    </div>
                    <!-- .car price -->

                </div>
                <!-- .Home Single header -->



            </div>
            
            <!-- .pagination & sort by -->

        <?php $i=0;
                $start=0; 
                $end=0;
            foreach ($DealerMakeMap as $DealerMake) {
                if($i==0){ $start++;?><div class="row"><?php }
        ?>

            

                <!-- car small -->
                <div class="four columns">
                    <div class="car-box horizontal small clearfix">

                        <!-- image -->
                        <div class="car-image">
                            <a href="#">
                                <?php if($DealerMake->makes->image!=""){ ?><img src="{{ url('/')}}/public/uploads/carmake/thumb/{{$DealerMake->makes->image}}" title="car" alt="car" /><?php }else{ ?>
                                <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                            <?php } ?>
                                
                            </a>
                        </div>
                        <!-- .image -->

                        <!-- content -->
                        <div class="car-content">

                            <!-- title -->
                            <div class="car-title">
                                <h3><a href="#"><?php echo $DealerMake->makes->name;?></a>
                                </h3>
                            </div>
                            <!-- .title -->

                            <!-- price -->
                            <div class="car-price">
                                <a href=""  id="deletemake" data-id="<?php echo $DealerMake->makes->id;?>" class="clearfix deletemake">
                                    <span class="price">Delete</span>
                                    <span class="icon-arrow-right2"></span>
                                </a>
                            </div>
                            <!-- .price -->

                        </div>
                        <!-- .content -->

                    </div>
                </div>
                <!-- .car small -->

                

           
        <?php   if($i==2){
                    $end++;
                    ?></div><?php
                    $i=0;
                    }else{
                    $i++;
                    }
            } 
            if($start!=$end){?></div><?php }
        ?>




           
            

            

        </div>

        </div>


    </section>

    <!-- ================================================== END Home Listing ============================================== -->


@stop