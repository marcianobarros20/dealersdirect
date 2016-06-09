@extends('front/layout/clientfrontend_template')
@section('content')
<section>
    <div class="container client-engine">
    <div class="col-md-2 col-md-offset-5"><h2> Transmission </h2></div>
        @foreach ($Transmission as $key => $value)
        <div class="row col-xs-12 col-sm-12 col-md-12">
            <div class="client-add">
                <div class="font-text">
                    <i class="fa fa-wrench"></i>{!! $RequestQueue->makes->name; !!}
                    <i class="fa fa-key font-a"></i>{!! $RequestQueue->models->name; !!}
                    <i class="fa fa-calendar font-a"></i>{!! $RequestQueue->year; !!}
                </div>
                <div class="dealer-info">
                    <h3>{!!  $value->name !!}</h3>
                    <p><span style="color:#000; font-weight: bold;">Name:</span>{!!  $value->name !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Transmission Type:</span>{!!  $value->transmissionType !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Number Of Speeds:</span>{!!  $value->numberOfSpeeds !!}</p>
                    <button   data-id="{!!  $RequestQueue->id !!}" data-count="{!!$countnum!!}" data-transmissionid="{!!  $value->transmission_id !!}" type="button" class="btn btn-default c-p  add_transmission"><i class="fa fa-check"></i>
                    Add This Transmission</button>
                </div>  
            </div>
        </div>
        @endforeach
    </div>

</section> 

@stop