@extends('front/layout/dealerfrontend_request_template')
@section('content')
		
<section class="dealer_request_area">
    <div class="container requs-make-list">
        <div class="row">
            
            <div class="col-xs-12 col-sm-3 col-md-3 list_request">
                <div class="btn-new">
                    <h3>Search By Make</h3>
                    <div class="request-list">
                        {{  Form::select('make_search', $Makes,null,array('id'=>'make_search')) }}
                    </div>
                </div>

                    <div class="border"></div>
                    <div class="btn-new">
                        <h3>Search By Status</h3>
                        {{  Form::select('status_search', $Status,null,array('id'=>'status_search')) }}
                    </div>
                    <div class="border"></div>
                    <div class="text-new-area">
                        <h3>One Time Payment</h3>
                        
                        {{ Form::text('onesearchmin','',['id' =>'onesearchmin','placeholder' => 'Min Price','class'=>'form-control form-in-control']) }}
                        <br>
                        {{ Form::text('onesearchmax','',['id' =>'onesearchmax','placeholder' => 'Max Price','class'=>'form-control form-in-control f-c']) }}
                    </div>
                    <div class="border"></div>
                    <ul class="nav nav-pills nav-stacked submit_btn">
                        <li><a  id="op" href="">Submit
                            <i class="fa fa-chevron-circle-right pull-right i-c"></i>
                        </a></li>
                    </ul>
                    <div class="border"></div>
                    <div class="text-new-area">
                        <h3>Monthly Payment</h3>
                        {{ Form::text('monsearchmin','',['id' =>'monsearchmin','placeholder' => 'Min Price','class'=>'form-control form-in-control']) }}
                        <br>
                        {{ Form::text('monsearchmax','',['id' =>'monsearchmax','placeholder' => 'Max Price','class'=>'form-control form-in-control f-c']) }}
                    </div>
                    <div class="border"></div>  
                    <ul class="nav nav-pills nav-stacked submit_btn">
                        <li><a  id="mp" href="">Submit
                            <i class="fa fa-chevron-circle-right pull-right i-c"></i>
                        </a></li>
                    </ul>
                    
            </div>
            
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="brand-section">
                    <!-- <div class="container"> -->
                        <div id="loading" class="row" >
                            <img  style=" height:100%;margin: auto; top: 0;left: 0; right: 0;  bottom: 0;" src="{{ url('/')}}/public/front/images/loader.gif">
                        </div>
                        <div id="sorry" class="row"  style="font-style: italic;    font-weight: bolder;    padding-left: 21%;    padding-top: 21%;">
                            
                        </div>
                        <div class="" id="results">
                            
                        </div>
                    <!-- </div>
                    </div> --> <!-- given for scroll bar -->
                </div>
            </div>
        </div> <!-- /row col-xs-12 select_option -->    
    </div><!--  /container --> 
</section>

@stop