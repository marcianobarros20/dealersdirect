@extends('front/layout/clientfrontend_template')
@section('content')
<section>
    <div class="container add-client-container">
    <div class="col-md-2 col-md-offset-5"><h2>Body Style</h2></div>
        @foreach ($Stylenew as $key => $value)
        <div class="col-xs-12 col-sm-12 col-md-12 client-row">
            <div class="add-details">
                <div class="font-text">
                    <i class="fa fa-wrench"></i>{!! $RequestQueue->makes->name; !!}
                    <i class="fa fa-key font-a"></i>{!! $RequestQueue->models->name; !!}
                    <i class="fa fa-calendar font-a"></i>{!! $RequestQueue->year; !!}
                </div>
                <div class="dealer-info">
                    <h3>{!!  $value->name !!}</h3>
                    <p><span style="color:#000; font-weight: bold;">Body:</span>{!!  $value->body !!}</p>
                    <p><span style="color:#000; font-weight: bold;">Trim:</span>{!!  $value->trim !!}</p>
                    <button data-id="{!!  $RequestQueue->id !!}" data-styleid="{!!  $value->style_id !!}" type="button" class="btn btn-default c-p  add_style"><i class="fa fa-check"></i>
                    Add This Style</button>
                </div>  
            </div>
        </div>
        @endforeach
    </div>
</section> 
@stop