<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{$RequestStyleEngineTransmissionColor->styles->name}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                @if(isset($RequestStyleEngineTransmissionColor->styles))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Style</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Style Name</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->styles->name}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Body</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->styles->body}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Trim</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->styles->trim}}</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($RequestStyleEngineTransmissionColor->engines))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Engine</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Engine</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->name}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Compression Ratio</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->compressionRatio}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Cylinder</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->cylinder}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Size</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->size}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Displacement</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->displacement}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Configuration</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->configuration}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Fuel Type</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->fuelType}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Horsepower</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->horsepower}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Torque</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->torque}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Total Valves</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->totalValves}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Type</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->type}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Code</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->code}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Compressor Type</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->engines->compressorType}}</div>
                                                </div>
                                                @if(!empty($RequestStyleEngineTransmissionColor->engines->rpm))
                                                    @foreach (json_decode($RequestStyleEngineTransmissionColor->engines->rpm,true) as $key => $rpm)
                                                        <div class="row show-grid">
                                                        <div class="col-xs-3  col-md-3">RPM ({{$key}})</div>
                                                        <div class="col-xs-9 col-md-9">{{$rpm}}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(!empty($RequestStyleEngineTransmissionColor->engines->valve))
                                                    @foreach (json_decode($RequestStyleEngineTransmissionColor->engines->valve,true) as $keyv => $valve)
                                                        <div class="row show-grid">
                                                        <div class="col-xs-3  col-md-3">Valve ({{$keyv}})</div>
                                                        <div class="col-xs-9 col-md-9">{{$valve}}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($RequestStyleEngineTransmissionColor->transmission))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Transmission</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Transmission</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->transmission->name}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Transmission Type</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->transmission->transmissionType}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Number Of Speeds</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->transmission->numberOfSpeeds}}</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($RequestStyleEngineTransmissionColor->excolor))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Exterior Color</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Color</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->excolor->name}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">View</div>
                                                <div class="col-xs-9 col-md-9"><a href="" class="button" style="background-color:#{{$RequestStyleEngineTransmissionColor->excolor->hex}} !important;"></a></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($RequestStyleEngineTransmissionColor->incolor))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Interior Color</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Color</div>
                                                <div class="col-xs-9 col-md-9">{{$RequestStyleEngineTransmissionColor->incolor->name}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">View</div>
                                                <div class="col-xs-9 col-md-9"><a href="" class="button" style="background-color:#{{$RequestStyleEngineTransmissionColor->incolor->hex}} !important;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>


            