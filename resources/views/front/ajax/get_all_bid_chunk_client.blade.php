@foreach($BidQueue as $key=>$Bid)

<div class="col-xs-12 col-sm-4 col-md-4 carousel_area">
        <div class="brand_request" @if($Bid->req_contact=="1")style="background-color:#fff0e6;"@endif>
            
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
            <h2>
            @if($Bid->req_contact=="1" && $Bid->payment_status=="1")
            @if($Bid->dealers->parent_id==0)
            {!! $Bid->dealers->dealership_name !!} 
            @else
            {!! $Bid->dealers->dealer_parent->dealership_name !!} 
            @endif
            @else
            Anyonymus
            @endif
            </h2>
            <div class="btns">
                
                @if($Bid->trade_in!=0)  
                <button type="button" class="btn btn-default c-p-b">Trade In : <?php $DoubleTrade_in=floatval($Bid->trade_in);echo "$".number_format($DoubleTrade_in,2);?></button>
                @endif              
                <button type="button" class="btn btn-default c-p-b">OneTime : <?php $DoubleOnetime=floatval($Bid->total_amount);echo "$".number_format($DoubleOnetime,2);?></button>
                <button type="button" class="btn btn-default c-p-b">Monthly : <?php $DoubleMonthly=floatval($Bid->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></button>
                
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
<script src="<?php echo url('/');?>/public/front_end/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.oppomod').click(function(){
            
            var dealer=$(this).data('id');
            var requestid=$(this).data('idx');
            console.log(requestid);
            //$(".modal-body").html(dx);
            $.ajax({
                    url: "<?php echo url('/');?>/ajax/getbidchistory",
                    data: {dealer:dealer,requestid:requestid,_token: '{!! csrf_token() !!}'},
                    type :"post",
                    success: function( data ) {
                        if(data){
                            
                            $(".modal-body").html('');
                            $(".modal-body").html(data);

                        }
                    }
                });
        });
});
</script>
