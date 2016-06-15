@extends('front/layout/dealerfrontend_request_template')
@section('content')
<input type="hidden" id="sortby" value="{{$fill}}">
<input type="hidden" id="pagestart" value="0">
<input type="hidden" id="pageend" value="2">
<input type="hidden" id="requestid" value="{{base64_encode($RequestQueue->id)}}">
<input type="hidden" id="nsd" value="{{base64_encode($RequestQueue->request_dealer_log->id)}}">
<section>
    <div class="container d-r-d">
        <div class="detail-text">
            <div class="col-xs-8">
                <h4><i class="fa fa-calendar"></i>{{$RequestQueue->created_at}}<h4>
                <h2>{{$RequestQueue->makes->name}}</h2>
            </div>
            
        </div>
     
        
        <div class="post-bid">
            <div class="col-xs-12 col-sm-8 col-md-8">
            <!-- Carousel ============ -->
                <div id = "myCarousel" class = "carousel slide deal-caro ctborder">
                   
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
                   <div class = "carousel-inner client-caro-img">
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
                @if(count($RequestQueue->bids)!=0)
                <div class="col-md-12 d-v">
                    <select id="shortoptions">
                        <option value="" >Sort By</option>
                        <option value="1" @if($fill==1)selected="selected"@endif>Best Pick</option>
                        <option value="2" @if($fill==2)selected="selected"@endif>Best Monthly</option>
                        <option value="3" @if($fill==3)selected="selected"@endif>Best Onetime</option>
                        <option value="4" @if($fill==4)selected="selected"@endif>Best Location</option>
                </select>
                </div>
                @endif
                <div class="brand-sec bidlist">
                    
                </div>
            </div>  <!-- /col-xs-8 -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                @if($RequestQueue->request_dealer_log->blocked=="1")
                    <button type="button" class="btn btn-default c-v">Blocked</button>
                @else
                    @if($RequestQueue->status!=1)
                        @if($BidQueuecount==0)
                        <button type="button" data-id="{{base64_encode($RequestQueue->request_dealer_log->id)}}" class="btn btn-default c-v dealpostbid">POST A BID</button>
                        @else
                        <button type="button" data-id="{{base64_encode($RequestQueue->request_dealer_log->id)}}" class="btn btn-default c-v dealstopbid">STOP BID</button>
                        <button type="button" data-id="{{base64_encode($RequestQueue->request_dealer_log->id)}}" class="btn btn-default c-v dealeditbid">EDIT YOUR BID</button>
                        @endif
                    @endif
                @endif
                
                
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs profile-browse postbid-browse" data-tabs="tabs">
                        <li class="active"><a href="#requestdetail" data-toggle="tab">Details</a></li>
                        @if(!empty($RequestQueue->trade_ins) && $RequestQueue->trade_ins->make_id!=0)
                        <li ><a href="#tradein" data-toggle="tab">Trade-In</a></li>
                        @endif
                        <li ><a href="#userinfo" data-toggle="tab">User-Info</a></li>
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
                                        <td>MAKE :</td> 
                                        <td>{{$RequestQueue->makes->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MODEL :</td> 
                                        <td>{{$RequestQueue->models->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>YEAR :</td> 
                                        <td>{{$RequestQueue->year}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>CONDITION :</td> 
                                        <td>{{$RequestQueue->condition}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>TOTAL AMOUNT :</td> 
                                        <td><?php $DoubleTotal=floatval($RequestQueue->total_amount);echo "$".number_format($DoubleTotal,2);?></td> 
                                    </tr> 
                                    <tr> 
                                        <td>MONTHLY AMOUNT :</td> 
                                        <td><?php $DoubleMonthly=floatval($RequestQueue->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="tab-pane form-head" id="userinfo">
                            <table class="table client-table"> 
                            @if($RequestQueue->client_id!=0)
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>Client Name :</td> 
                                        <td>{{$RequestQueue->clients->first_name}} {{$RequestQueue->clients->last_name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Email :</td> 
                                        <td>{{$RequestQueue->clients->email}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Phone :</td> 
                                        <td>{{$RequestQueue->clients->phone}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Zip :</td> 
                                        <td>{{$RequestQueue->clients->zip}}</td> 
                                    </tr> 
                                    
                                </tbody> 
                            @else
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>Client Name :</td> 
                                        <td>{{$clx['first_name']}} {{$clx['last_name']}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Email :</td> 
                                        <td>{{$clx['email']}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Phone :</td> 
                                        <td>{{$clx['phone']}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Zip :</td> 
                                        <td>{{$clx['zip']}}</td> 
                                    </tr> 
                                    
                                </tbody>
                            @endif
                            </table>
                        </div>
                        @if(!empty($RequestQueue->trade_ins)&& $RequestQueue->trade_ins->make_id!=0)
                            <div class="tab-pane form-head" id="tradein">
                                <table class="table client-table"> 
                                    <tbody class="post-text"> 
                                        <tr> 
                                            <td>Trade-IN MAKE :</td> 
                                            <td>{{$RequestQueue->trade_ins->makes->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN MODEL :</td> 
                                            <td>{{$RequestQueue->trade_ins->models->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN CONDITIONS :</td> 
                                            <td>{{$RequestQueue->trade_ins->condition}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN YEAR :</td> 
                                            <td>{{$RequestQueue->trade_ins->year}}</td> 
                                        </tr> 
                                        @if($RequestQueue->trade_ins->owe==1)
                                        <tr> 
                                            <td>Trade-IN OWE Amount :</td> 
                                            <td><?php $DoubleTrade_ins=floatval($RequestQueue->trade_ins->owe_amount);echo "$".number_format($DoubleTrade_ins,2);?></td> 
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
                                                            <td>{{$key}} :</td> 
                                                            <td>${{$price}}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <tr> 
                                                <td>Style Name :</td> 
                                                <td>{{$option->styles->name}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Body :</td> 
                                                <td>{{$option->styles->body}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Compression Ratio :</td> 
                                                <td>{{$option->engines['compressionRatio']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Cylinder :</td> 
                                                <td>{{$option->engines['cylinder']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Displacement :</td> 
                                                <td>{{$option->engines['displacement']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Configuration :</td> 
                                                <td>{{$option->engines['configuration']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Fuel Type :</td> 
                                                <td>{{$option->engines['fuelType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Torque :</td> 
                                                <td>{{$option->engines['torque']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Total Valves :</td> 
                                                <td>{{$option->engines['totalValves']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Code :</td> 
                                                <td>{{$option->engines['code']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type :</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type :</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            @if(!empty($option->engines['rpm']))
                                                @foreach (json_decode($option->engines['rpm'],true) as $key => $rpm)
                                                <tr> 
                                                    <td>RPM ({{ $key }}) :</td> 
                                                    <td>{{  $rpm }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->engines['valve']))
                                                @foreach (json_decode($option->engines['valve'],true) as $keyv => $valve)
                                                <tr> 
                                                    <td>Valve ({{ $keyv }}) :</td> 
                                                    <td>{{  $valve }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->excolor))
                                                <tr> 
                                                    <td>Exterior Color :</td> 
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
                                                    <td>Interior Color :</td> 
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

<!-- modal fade -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bid Information</h4>
        </div>
        <div class="modal-body">
                        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
          Close</button>
          
        </div>
      </div>
    </div>
</div>
<!-- ./modal fade -->
@stop