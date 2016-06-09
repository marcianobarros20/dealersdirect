@extends('front/layout/clientfrontend_template')
@section('content')
<section>
    <div class="container client-engine">
    <div class="col-md-2 col-md-offset-5"><h2> Engine </h2></div>
        @foreach ($Engine as $key => $value)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="client-add">
                <div class="font-text">
                    <i class="fa fa-wrench"></i>{!! $RequestQueue->makes->name; !!}
                    <i class="fa fa-key font-a"></i>{!! $RequestQueue->models->name; !!}
                    <i class="fa fa-calendar font-a"></i>{!! $RequestQueue->year; !!}
                </div>
                <div class="dealer-info">
                    <h3>{!!  $value->name !!}</h3>
                    

                    <p><span style="color:#000; font-weight: bold;">Compression Ratio :</span> {!!  $value->compressionRatio !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Cylinder :</span> {!!  $value->cylinder !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Size :</span> {!!  $value->size !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Displacement :</span> {!!  $value->displacement !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Configuration :</span> {!!  $value->configuration !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Fuel Type :</span> {!!  $value->fuelType !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Horsepower :</span> {!!  $value->horsepower !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Torque :</span> {!!  $value->torque !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Total Valves :</span> {!!  $value->totalValves !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Type :</span> {!!  $value->type !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Code :</span> {!!  $value->code !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Compressor Type :</span> {!!  $value->compressorType !!}</p>
                    @if(!empty($value->rpm))
                        @foreach (json_decode($value->rpm,true) as $key => $rpm)
                    <p><span style="color:#000; font-weight: bold;">RPM ({!! $key !!}):</span> {!!  $rpm !!}</p>
                        @endforeach
                    @endif
                    @if(!empty($value->valve))
                        @foreach (json_decode($value->valve,true) as $keyv => $valve)
                    <p><span style="color:#000; font-weight: bold;">Valve ({!! $keyv !!}):</span> {!!  $valve !!}</p>
                        @endforeach
                    @endif
                    <button  data-id="{!!  $RequestQueue->id !!}" data-count="{!!$countnum!!}" data-engineid="{!!  $value->engine_id !!}"  type="button" class="btn btn-default c-p   add_engine"><i class="fa fa-check"></i>
                    Add This Engine</button>
                </div>  
            </div>
        </div>
        @endforeach
    </div>
</section> 


@stop