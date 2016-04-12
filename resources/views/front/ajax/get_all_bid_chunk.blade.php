@foreach($BidQueue as $key=>$Bid)
<div class="col-xs-12 col-sm-4 col-md-4 carousel_area">
        <div class="brand_request">
            
            <div id = "myCarousel{{$key}}" class = "carousel slide">

            
                <ol class = "carousel-indicators">
                @if(!empty($Bid->bid_image))
                    @foreach($Bid->bid_image as $vx=>$img)
                    <li data-target = "#myCarousel{{$key}}" data-slide-to = "{{$vx}}" @if($vx==0)class = "active"@endif></li>
                    @endforeach
                @else
                    <li data-target = "#myCarousel{{$key}}" data-slide-to = "0" class = "active"></li>
                @endif
                </ol>   

            
                <div class = "carousel-inner">
                @if(!empty($Bid->bid_image))
                @foreach($Bid->bid_image as $vx=>$img)
                    <div class = "item @if($vx==0) active @endif">
                        <img src = "{{ url('/')}}/public/uploads/project/{{$img->image}}" alt = "x">
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
            <h2>{!! $Bid->dealers->first_name !!} {!! $Bid->dealers->last_name !!} </h2>
            <div class="btns">
                
                @if($Bid->trade_in!=0)  
                <button type="button" class="btn btn-default c-p-b">Trade In:{!! $Bid->trade_in !!}</button>
                @endif              
                <button type="button" class="btn btn-default c-p-b">OneTime:{!! $Bid->total_amount !!}</button>
                <button type="button" class="btn btn-default c-p-b">Monthly:{!! $Bid->monthly_amount !!}</button>
                
            </div>
            <div class="btn-group oppomod"  data-toggle="modal" data-target="#myModal" data-id={!! $Bid->dealer_id !!} data-idx={!! $Bid->requestqueue_id !!}>
                <button type="button" class="btn btn-success">OPEN</button>
                <button type="button" class="btn btn-warning">
                    <i class="fa fa-long-arrow-right"></i>
                </button>
            </div>
        </div>
    </div> 
@endforeach
<script src="<?php echo url('/');?>/public/front_end/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.oppomod').click(function(){
			
			var dealer=$(this).data('id');
			var requestid=$(this).data('idx');
			//$(".modal-body").html('');
			//$(".modal-body").html(dx);
			$.ajax({
					url: "<?php echo url('/');?>/ajax/getbidhistory",
					data: {dealer:dealer,requestid:requestid,_token: '{!! csrf_token() !!}'},
					type :"post",
					success: function( data ) {
						if(data){
							$(".modal-body").html('');
							$(".modal-body").html(data)
						}
					}
				});
		});
});
</script>