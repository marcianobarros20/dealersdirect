
@foreach($RS as $key=>$RequestLog)

    <div class="col-xs-12 col-sm-4 col-md-4 costo-get-all">
        <div class="brand_request">
            
            <div id = "myCarousel{{$key}}" class = "carousel slide">

            
                <ol class = "carousel-indicators">
                @if($RequestLog->imx!="")
                    @foreach($RequestLog->imx as $vx=>$img)
                    <li data-target = "#myCarousel{{$key}}" data-slide-to = "{{$vx}}" @if($vx==0)class = "active"@endif></li>
                    @endforeach
                @else
                    <li data-target = "#myCarousel{{$key}}" data-slide-to = "0" class = "active"></li>
                @endif
                </ol>   

            
                <div class = "carousel-inner get-all-caro">
                @if($RequestLog->imx!="")
                @foreach($RequestLog->imx as $vx=>$img)
                    <div class = "item @if($vx==0) active @endif">
                        <img src = "{{ url('/')}}/public/edmunds/make/small/{{$img->local_path_smalll}}" alt = "x">
                    </div>
                @endforeach 
                @else
                <div class = "item active">
                        <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                </div>
                @endif 
                </div>

            
                <a class = "carousel-control left" href = "#myCarousel{{$key}}" data-slide = "prev">&lsaquo;</a>
                <a class = "carousel-control right" href = "#myCarousel{{$key}}" data-slide = "next">&rsaquo;</a>

            </div> 
            <h2>{!! $RequestLog->makes->name !!} </h2>
            <div class="btns coust-buton">
                <button type="button" class="btn btn-default c-p-b">{!! $RequestLog->requestqueue->models->name !!}</button>
                @if($RequestLog->blocked==1)
                <button type="button" class="btn btn-default c-p-b">BLOCKED</button>
                @endif
                @if($RequestLog->accepted_state!=0)
                <button type="button" class="btn btn-default c-p-b">Accepted</button>
                @endif
                @if($RequestLog->rejected_state!=0)
                <button type="button" class="btn btn-default c-p-b">Rejected</button>
                @endif
                <button type="button" class="btn btn-default c-p-b">{!! $RequestLog->requestqueue->year !!}</button>
                <button type="button" class="btn btn-default c-p-b">OneTime : <?php $DoubleTotal=floatval($RequestLog->requestqueue->total_amount);echo "$".number_format($DoubleTotal,2);?></button>
                <button type="button" class="btn btn-default c-p-b">Monthly : <?php $DoubleMonthly=floatval($RequestLog->requestqueue->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></button>
                
            </div>
            <a href="<?php echo url('/');?>/dealers/request_detail/<?php echo base64_encode($RequestLog->id);?>" class="btn-group">
                <button type="button" class="btn btn-success">OPEN</button>
                <button type="button" class="btn btn-warning">
                    <i class="fa fa-long-arrow-right"></i>
                </button>
            </a>
        </div>
    </div> 

@endforeach
