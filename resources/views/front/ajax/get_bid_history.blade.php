@foreach($BidQueue as $key=>$Bid)
<div class="detal-c modal-down">
    <div class="row img-area">
        @if(!empty($Bid->bid_image))
        @foreach($Bid->bid_image as $vx=>$img)
        <div class="col-xs-12 col-sm-12 col-md-6 image-view">
            <img src="{{ url('/')}}/public/uploads/project/{{$img->image}}" class="img-responsive" alt="Responsive image">
        </div>
        @endforeach 
        @else
        <div class="col-xs-12 col-sm-12 col-md-6 image-view">
            <img src="{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" class="img-responsive" alt="Responsive image">
        </div>
        @endif 
    </div>
    <h2><i class="fa fa-reply"></i> @if($Bid->dealers->parent_id==0)
            {!! $Bid->dealers->dealership_name !!} 
            @else
            {!! $Bid->dealers->dealer_parent->dealership_name !!} 
            @endif <small>{!! $Bid->dealers->created_at!!}</small></h2>
    <div class="information">
        <p>Monthly: <?php $DoubleMonthly=floatval($Bid->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></p>
        <p>Total: <?php $DoubleTotal=floatval($Bid->total_amount);echo "$".number_format($DoubleTotal,2);?></p>
        @if($Bid->trade_in!=0)
        <p><i class="fa fa-suitcase"></i> Trade In: <?php $DoubleTrade_in=floatval($Bid->trade_in);echo "$".number_format($DoubleTrade_in,2);?></p>
        @endif
        <p>Details: {!! $Bid->details !!}</p>
        @if($Bid->status==3)
        <span class="label success">Accepted</span>
        @endif
        @if($Bid->status==2)
        <span class="label error">Rejected</span>
        @endif
        @if($Bid->visable==1 && $Bid->blocked!=1 && $Bid->status!=2)

        <button type="button" class="btn btn-success">Visible</button>
        @endif
        @if($Bid->status==2)

        <button type="button" class="btn btn-warning">Rejected</button>
        @endif
        @if($Bid->status==3)

        <button type="button" class="btn btn-info">Accepted</button>
        @endif
        @if($Bid->blocked==1)
        <button type="button" class="btn btn-danger">Blocked</button>
        @endif
        <!-- <div class="form-group">
            <label for="exampleInputName1">Details</label>
            <textarea type="name" class="form-control profile_control" rows="5" id="exampleInputName1" placeholder=""></textarea>
            <div class="btns">
                <button type="button" class="btn btn-default c-p"><i class="fa fa-check"></i> Accept</button>
                <button type="button" class="btn btn-default c-p"><i class="fa fa-times"></i> Reject</button>
                <button type="button" class="btn btn-default c-p"><i class="fa fa-ban"></i> Block</button>
            </div>
        </div> -->
    </div>
</div>
@endforeach