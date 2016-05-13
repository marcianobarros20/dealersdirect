@extends('front/layout/dealerfrontend_request_template')
@section('content')
            
<section> 

    <div class="container post-container">

        <div class="intro-text">
            <h4><i class="fa fa-calendar"></i>{{$RequestQueue->created_at}}<h4>
            
            <h2>{{$RequestQueue->makes->name}}</h2>
            
            <P>POST A BID </P>
            @if(Session::get('error'))
            <div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('error') }} 
                <a href="#" class="close" data-dismiss="alert">×</a>
            </div>
            @endif  
        </div>
        <div class="post-bid">
            <div class="col-xs-12 col-sm-8 col-md-8">
                {{ Form::open(array('url' => 'postbid', 'files'=>true)) }}
                    <div class="form_back">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total Amount</label>
                            {{ Form::hidden('id',$RequestQueue->id,'') }}
                            {{ Form::hidden('request_id',$RequestQueue->request_dealer_log->id,'') }}
                            {{ Form::text('total_amount','',['class' => 'form-control profile_control','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Monthly Amount</label>
                            {{ Form::text('monthly_amount','',['class' => 'form-control profile_control','required'=>'required']) }}
                        </div>
                        @if(!empty($RequestQueue->trade_ins)&& $RequestQueue->trade_ins->make_id!=0)
                        <div class="form-group">
                            <label for="exampleInputName1">Trade In Amount</label>
                            {{ Form::text('trade_in','',['class' => 'form-control profile_control']) }}
                        </div>
                        @else
                            {{ Form::hidden('trade_in',0,['class' => 'form-control profile_control']) }}

                                                        
                        @endif
                        <div class="form-group">
                            <label for="exampleInputName1">Details</label>
                           
                            {{ Form::textarea('details','',['class'=>'form-control profile_control','rows'=>'5','required'=>'required']) }}
                        </div>
                        <div class="imagecontainer">
                            
                        </div>
                        <div class="image-btn">
                        <a class="btn btn-warning addimagecontain" href=""><i class="fa fa-picture-o"></i> Add Images</a>

                        
                        </div>
                       
                        {{ Form::submit('POST BID',array('class' => 'btn btn-default btn-lg btn-block')) }}
                    </div> <!-- /form_back -->
                {!! Form::close() !!}
            </div>  <!-- /col-xs-8 -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs profile-browse postbid-browse" data-tabs="tabs">
                        <li class="active"><a href="#requestdetail" data-toggle="tab">Details</a></li>
                        @if(!empty($RequestQueue->trade_ins)&& $RequestQueue->trade_ins->make_id!=0)
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
                                        <td><?php $DoubleTotal=floatval($RequestQueue->total_amount);echo "$".number_format($DoubleTotal,2);?></td> 
                                    </tr> 
                                    <tr> 
                                        <td>MONTHLY AMOUNT:</td> 
                                        <td><?php $DoubleMonthly=floatval($RequestQueue->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="tab-pane form-head" id="userinfo">
                            <table class="table client-table"> 
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>Client Name:</td> 
                                        <td>{{$RequestQueue->clients->first_name}} {{$RequestQueue->clients->last_name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Email:</td> 
                                        <td>{{$RequestQueue->clients->email}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Phone:</td> 
                                        <td>{{$RequestQueue->clients->phone}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Client Zip:</td> 
                                        <td>{{$RequestQueue->clients->zip}}</td> 
                                    </tr> 
                                    
                                </tbody> 
                            </table>
                        </div>
                        @if(!empty($RequestQueue->trade_ins)&& $RequestQueue->trade_ins->make_id!=0)
                        <div class="tab-pane form-head" id="tradein">
                            <table class="table client-table"> 
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>Trade-IN MAKE:</td> 
                                        <td>{{$RequestQueue->trade_ins->makes->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Trade-IN MODEL:</td> 
                                        <td>{{$RequestQueue->trade_ins->models->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Trade-IN CONDITIONS:</td> 
                                        <td>{{$RequestQueue->trade_ins->condition}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Trade-IN YEAR:</td> 
                                        <td>{{$RequestQueue->trade_ins->year}}</td> 
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