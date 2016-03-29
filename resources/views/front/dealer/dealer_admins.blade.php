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
                            <h3><?php echo Session::get('dealer_name');?> Your Admin List</h3>
                        </div>
                        <!-- .car title -->

                    </div>


                    <!-- car price -->
                    <div class="two columns" data-appear-animation="slideInRight">
                        <div class="single-car-price clearfix">
                            <a href="<?php echo url('/');?>/dealers/dealer_add_admin" class="button light medium"><b>Add Admin</b></a>
                        </div>
                    </div>
                    <!-- .car price -->

                </div>
                <!-- .Home Single header -->
                <div class="home-single-body clearfix">


                </div>
                <div data-appear-animation="bounceIn" class="twelve columns alpha space-top-and-bottom small carell-animation bounceIn carell-animation-visible">
               
                {{--*/ $i =0 /*--}}
                {{--*/ $start =0 /*--}}
                {{--*/ $end =0 /*--}}
               
                @foreach ($Dealers as $Dealer)
                    @if($i==0)
                        {{--*/ $start++ /*--}}
                    <div class="row">
                    @endif
                

            

                    <!-- car small -->
                    <div class="six columns">
                        <div class="car-box horizontal small clearfix">

                            <!-- image -->
                            <div class="car-image">
                                <a href="#">
                                    @if(!empty($Dealer->dealer_details))
                                        @if($Dealer->dealer_details->image!="")
                                        <img src="{{ url('/')}}/public/dealers/{{$Dealer->dealer_details->image}}" title="car" alt="car" />
                                        @else
                                        <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                                        @endif
                                    @else
                                    <img src="<?php echo url('/');?>/public/front/images/car-1.jpg" title="car" alt="car" />
                                    @endif
                                    
                                </a>
                            </div>
                        <!-- .image -->

                            <!-- content -->
                            <div class="car-content">

                                <!-- title -->
                                <div class="car-title">
                                    <p><strong>Name:</strong>{!! $Dealer->first_name !!} {!! $Dealer->last_name !!}</p>
                                    <p><strong>Email:</strong>{!! $Dealer->email !!} {!! $Dealer->last_name !!}</p>
                                    @if(!empty($Dealer->dealer_details))
                                    <p><strong>Zip:</strong>{!! $Dealer->dealer_details->zip !!}</p>
                                    <p><strong>Phone:</strong>{!! $Dealer->dealer_details->phone !!}</p>
                                    @endif
                                </div>
                                <!-- .title -->

                                <!-- price -->
                                <!-- <div class="car-price">
                                    <a href=""  id="deletemake" data-id="" class="clearfix deletemake">
                                        <span class="price">Delete</span>
                                        <span class="icon-arrow-right2"></span>
                                    </a>
                                </div> -->
                                <!-- .price -->

                            </div>
                            <!-- .content -->

                        </div>
                    </div>
                    <!-- .car small -->

                

           
                    @if($i==1)
                        {{--*/ $end++ /*--}}
                        </div>
                        {{--*/ $i=0 /*--}}
                        
                    @else
                        {{--*/ $i++ /*--}}
                    @endif
                @endforeach 
                <?php if($start!=$end){?></div><?php }
                ?>


                        @if(empty($Dealer))
                        <div class="share">

                            <ul>
                                <li>Sorry No Admin List</li>
                                
                            </ul>

                        </div>
                        @endif
                    </div>

            </div>
            
            <!-- .pagination & sort by -->

        




           
            

            

        </div>

        </div>


    </section>

    <!-- ================================================== END Home Listing ============================================== -->


@stop