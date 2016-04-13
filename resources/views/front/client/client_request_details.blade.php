@extends('front/layout/clientfrontend_template')
@section('content')
<input type="hidden" id="sortby" value="1">
<input type="hidden" id="pagestart" value="0">
<input type="hidden" id="pageend" value="2">
<input type="hidden" id="requestid" value="{{base64_encode($RequestQueue->id)}}">

<section>
    <div class="container">
        <div class="row detail-text">
            <div class="col-md-4">
                <h4><i class="fa fa-calendar"></i>{{$RequestQueue->created_at}}<h4>
                <h2>{{$RequestQueue->makes->name}}</h2>
            </div>
            <div class="col-md-offset-1 col-md-4 d-v">
                <select id="shortoptions">
                        <option value="" >Sort By</option>
                        <option value="1" selected="selected">Best Pick</option>
                        <option value="2">Best Monthly</option>
                        <option value="3">Best Onetime</option>
                </select>
            </div>
        </div>
     
        
        <div class="row post-bid">
            <div class="col-xs-8">
            <!-- Carousel ============ -->
                <div id = "myCarousel" class = "carousel slide">
                   
                   <!-- Carousel indicators -->
                    <ol class = "carousel-indicators">
                    @if(!empty($EdmundsMakeModelYearImage))
                        @foreach($EdmundsMakeModelYearImage as $vx=>$img)
                        <li data-target = "#myCarousel" data-slide-to = "{{$vx}}"  @if($vx==0)class = "active"@endif ></li>
                        @endforeach
                    @else
                        <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
                    @endif
                    </ol>   
                   
                   <!-- Carousel items -->
                   <div class = "carousel-inner">
                   @if(!empty($EdmundsMakeModelYearImage))
                        @foreach($EdmundsMakeModelYearImage as $vx=>$img)
                            <div class = "item @if($vx==0) active @endif">
                                <img src = "{{ url('/')}}/public/edmunds/make/big/{{$img->local_path_big}}" alt = "x">
                            </div>
                        @endforeach 
                    @else
                            <div class = "item active">
                                <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                            </div>
                    @endif 
                   </div>
                   
                   <!-- Carousel nav -->
                   <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
                   <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
                   
                </div> <!-- /.carousel -->
                <div class="brand-sec bidlist">
                    
                </div>
            </div>  <!-- /col-xs-8 -->
            <div class="col-xs-4">
                
                <a href="{{url('/')}}/client/add-style/{{base64_encode($RequestQueue->id)}}" class="btn btn-default c-v">Add More Details</a>
                
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs profile-browse postbid-browse" data-tabs="tabs">
                        <li class="active"><a href="#requestdetail" data-toggle="tab">Details</a></li>
                        @if(!empty($RequestQueue->trade_ins))
                            <li><a href="#trad" data-toggle="tab">Trade In</a></li>
                        @endif
                        @if(!empty($RequestQueue->options))
                            @foreach($RequestQueue->options as $optionkey=>$option)
                                <li><a href="#options{{$optionkey+1}}" data-toggle="tab">Option{{$optionkey+1}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active form-head" id="requestdetail">
                            <table class="table client-table"> 
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>MAKE:</td> 
                                        <td>{{$RequestQueue->makes->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MODEL:</td> 
                                        <td>{{$RequestQueue->models->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>YEAR:</td> 
                                        <td>{{$RequestQueue->year}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>CONDITION:</td> 
                                        <td>{{$RequestQueue->condition}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>TOTAL AMOUNT:</td> 
                                        <td>{{$RequestQueue->total_amount}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MONTHLY AMOUNT:</td> 
                                        <td>{{$RequestQueue->monthly_amount}}</td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </div>
                        @if(!empty($RequestQueue->trade_ins))
                            <div class="tab-pane form-head" id="trad">
                                <table class="table client-table"> 
                                    <tbody class="post-text"> 
                                        <tr> 
                                            <td>Trade-IN MAKE</td> 
                                            <td>{{$RequestQueue->trade_ins->makes->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN MODEL</td> 
                                            <td>{{$RequestQueue->trade_ins->models->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN YEAR</td> 
                                            <td>{{$RequestQueue->trade_ins->year}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN CONDITION</td> 
                                            <td>{{$RequestQueue->trade_ins->condition}}</td> 
                                        </tr> 
                                        @if($RequestQueue->trade_ins->owe==1)
                                            <tr> 
                                                <td>Trade-IN OWE Amount:</td> 
                                                <td>{{$RequestQueue->trade_ins->owe_amount}}</td> 
                                            </tr> 
                                        @endif
                                        
                                    </tbody> 
                                </table>
                            </div>
                        @endif
                        @if(!empty($RequestQueue->options))
                            @foreach($RequestQueue->options as $optionkey=>$option)
                                <div class="tab-pane form-head" id="options{{$optionkey+1}}">
                                    <table class="table client-table"> 
                                        <tbody class="post-text">
                                            @if(!empty($option->styles->price))
                                                @foreach (json_decode($option->styles->price,true) as $key => $price)
                                                    @if($key=="baseMSRP")
                                                        <tr> 
                                                            <td>{{$key}}:</td> 
                                                            <td>{{$price}}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <tr> 
                                                <td>Style Name:</td> 
                                                <td>{{$option->styles->name}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Body:</td> 
                                                <td>{{$option->styles->body}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Compression Ratio:</td> 
                                                <td>{{$option->engines['compressionRatio']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Cylinder:</td> 
                                                <td>{{$option->engines['cylinder']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Displacement:</td> 
                                                <td>{{$option->engines['displacement']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Configuration:</td> 
                                                <td>{{$option->engines['configuration']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Fuel Type:</td> 
                                                <td>{{$option->engines['fuelType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Torque:</td> 
                                                <td>{{$option->engines['torque']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Total Valves:</td> 
                                                <td>{{$option->engines['totalValves']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Code:</td> 
                                                <td>{{$option->engines['code']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type:</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type:</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            @if(!empty($option->engines['rpm']))
                                                @foreach (json_decode($option->engines['rpm'],true) as $key => $rpm)
                                                <tr> 
                                                    <td>RPM ({{ $key }}):</td> 
                                                    <td>{{  $rpm }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->engines['valve']))
                                                @foreach (json_decode($option->engines['valve'],true) as $keyv => $valve)
                                                <tr> 
                                                    <td>Valve ({{ $keyv }}):</td> 
                                                    <td>{{  $valve }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->excolor))
                                                <tr> 
                                                    <td>Exterior Color:</td> 
                                                    <td>
                                                        {{$option->excolor['name']}}
                                                        @if($option->excolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->excolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                            @if(!empty($option->incolor))
                                                <tr> 
                                                    <td>Interior Color:</td> 
                                                    <td>
                                                        {{$option->incolor['name']}}
                                                        @if($option->incolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->incolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                        </tbody> 
                                    </table>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                </div>
            </div>  <!-- /col-xs-4 -->
        </div>
    </div>
</section>



@stop