@extends('front/layout/dealer_template')
@section('content')
		
   <!-- ================================================== PAGINATION ================================================== -->

    <section class="space-top-and-bottom medium">
        <div class="container">

            <div class="row">
                <!-- sidebar -->
                <div class="three columns" data-appear-animation="slideInLeft">
                    <div class="sidebar space-top">

                        <!-- MAKE -->
                        <div class="sidebar-widget clearfix">

                            <div class="widget-wrap search">

                                <div class="sidebar-title">
                                    <h4><b>Search By</b> Make</h4>
                                </div>

                                <div class="search-wrap">
                                    <form method="get" action="#">
                                        <fieldset>
                                            <div class="light-select-input">
                                                {{  Form::select('make_search', $Makes,null,array('id'=>'make_search')) }}
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- .MAKE -->

                        <!-- TYPE -->
                        <div class="sidebar-widget clearfix">

                            <div class="widget-wrap search">

                                <div class="sidebar-title">
                                    <h4><b>Search By</b> Status</h4>
                                </div>

                                <div class="search-wrap">
                                    <form method="get" action="#">
                                        <fieldset>
                                            <div class="light-select-input">
                                                {{  Form::select('status_search', $Status,null,array('id'=>'status_search')) }}
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- .TYPE -->

                        

                        <!-- archives -->
                        <div class="sidebar-widget clearfix">
                            <div class="widget-wrap list">

                                <div class="sidebar-title">
                                    <h4><b>OneTime </b>Payment</h4>
                                </div>
                                <ul class="widget-list clearfix">
                                    <li> 
                                    
                                    <div class="input search-input">
                                    <input type="text" name="onesearchmin" id="onesearchmin"placeholder="MIN PRICE" />
                                    </div>
                                    
                                    
                                    <div class="input search-input">
                                    <input type="text" name="onesearchmax" id="onesearchmax" placeholder="MAX PRICE" />
                                    </div> 
                                    </li>
                                    
                                    <li><a id="op" href="">SUBMIT</a> 
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <!-- .archives -->
                        <!-- archives -->
                        <div class="sidebar-widget clearfix">
                            <div class="widget-wrap list">

                                <div class="sidebar-title">
                                    <h4><b>Monthly </b>Payment</h4>
                                </div>
                                <ul class="widget-list clearfix">
                                    <li> 
                                    
                                    <div class="input search-input">
                                    <input type="text"  name="monsearchmin" id="monsearchmin"placeholder="MIN PRICE" />
                                    </div>
                                    
                                    
                                    <div class="input search-input">
                                    <input type="text" name="monsearchmax" id="monsearchmax" placeholder="MAX PRICE" />
                                    </div> 
                                    </li>
                                    
                                    <li><a id="mp" href="">SUBMIT</a> 
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <!-- .archives -->

                    </div>
                </div>
                <!-- .sidebar -->

                <!-- body -->
                <div class="nine columns" data-appear-animation="slideInRight">
                    <h2>Dealers <b>Request</b> List</h2>
                        <!-- <div class="three columns">
                            <div class="car-box vertical medium">

                                
                                <div class="car-image">
                                    <a href="#">
                                        <img alt="car" title="car" src="images/car-1.jpg">
                                        <span class="background">
                                            <span class="icon-plus"></span>
                                        </span>
                                    </a>
                                </div>
                                
                                <div class="car-content">

                                   
                                    <div class="car-title">
                                        <h3><a href="#">Very Nice House</a>
                                        </h3>
                                    </div>
                                    

                                   
                                    <div class="car-tags">
                                        <ul class="clearfix">
                                            <li>2012</li>
                                            <li>4 beds</li>
                                            <li>2 baths</li>
                                            <li>New York</li>
                                            <li>124m2</li>
                                        </ul>
                                    </div>
                                    

                                    
                                    <div class="car-price">
                                        <a class="clearfix" href="#">
                                        <span class="price">$12.350</span>
                                        <span class="icon-arrow-right2"></span>
                                        </a>
                                    </div>
                                    

                                </div>
                                

                            </div>
                        </div> -->
                        <div id="loading" class="" >
                            <img  style=" height:100%;margin: auto; top: 0;left: 0; right: 0;  bottom: 0;" src="{{ url('/')}}/public/front/images/loader.gif">
                        </div>
                        <div id="results" style="display:none;"></div>

                </div>
                <!-- .body -->



            </div>

    </section>

    <!-- ================================================== END PAGINATION ============================================== -->


@stop