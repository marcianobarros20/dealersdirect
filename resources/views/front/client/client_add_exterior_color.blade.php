@extends('front/layout/clientfrontend_template')
@section('content')
<section>
    <div class="container client-add-color">
    <div class="col-md-2 col-md-offset-5"><h2> Exterior Color </h2></div>
        @foreach ($Color as $key => $value)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="client-add">
                <div class="font-text">
                    <i class="fa fa-wrench"></i>{!! $RequestQueue->makes->name; !!}
                    <i class="fa fa-key font-a"></i>{!! $RequestQueue->models->name; !!}
                    <i class="fa fa-calendar font-a"></i>{!! $RequestQueue->year; !!}
                </div>
                <div class="dealer-info">
                    <h3>{!!  $value->name !!}</h3>
                    @if($value->hex!="")
                    <p><span style="color:#000; font-weight: bold;">View:</span><div class="color-border" style="min-width: 10%;background-color:#{{$value->hex}};">&nbsp;</div></p>
                    @endif
                    <button  data-id="{!!  $RequestQueue->id !!}" data-count="{!!$countnum!!}" data-colorid="{!!  $value->color_id !!}" type="button" class="btn btn-default c-p add_exterior_color"><i class="fa fa-check"></i>
                    Add This Exterior Color</button>
                </div>  
            </div>
        </div>
        @endforeach
    </div>
</section> 

@stop