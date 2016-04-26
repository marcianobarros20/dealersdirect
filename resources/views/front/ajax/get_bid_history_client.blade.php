@foreach($BidQueue as $key=>$Bid)
<div class="detal-c">
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
        <p>Monthly: {!! $Bid->monthly_amount !!}</p>
        <p>Total: {!! $Bid->total_amount !!}</p>
        @if($Bid->trade_in!=0)
        <p><i class="fa fa-suitcase"></i> Trade In: {!! $Bid->trade_in !!}</p>
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
        @if($Bid->visable==1 && $Bid->blocked!=1 && $Bid->status!=2)
        <div class="form-group">
            <label for="exampleInputName1">Details</label>
            <textarea type="name" class="form-control profile_control" rows="5" id="detresx" placeholder=""></textarea>
            <div class="btns">
                <button type="button" data-request="{!! $Bid->id !!}" class="btn btn-default c-p accepttrigger"><i class="fa fa-check"></i> Accept</button>
                <button type="button" data-request="{!! $Bid->id !!}"  class="btn btn-default c-p rejecttrigger"><i class="fa fa-times"></i> Reject</button>
                <button type="button" data-request="{!! $Bid->id !!}"  class="btn btn-default c-p blocktrigger"><i class="fa fa-ban"></i> Block</button>
            </div>
        </div>
        @endif
    </div>
</div>
@endforeach

<script type="text/javascript">
    $('.rejecttrigger').click(function(){
          var requestid=$(this).data("request");
          var rejectdetails=$("#detresx").val();
          console.log(requestid);
          console.log(rejectdetails);
          
          $.ajax({
                  url: "../../ajax/bidreject",
                  data: {requestid:requestid,rejectdetails:rejectdetails,_token: 'LmnW2p5nvlPNeVCzA9OXLmOKhnovxzVmAp2UsOkE'
},
                  type :"post",
                  success: function( data ) {
                    if(data){
                      window.location.reload();
                    }
                    
                  
                  }
          });
          return false;
  });
  $('.accepttrigger').click(function(){
        var requestid=$(this).data("request");
          var acceptdetails=$("#detresx").val();
          console.log(requestid);
          console.log(acceptdetails);
          
          $.ajax({
                  url: "../../ajax/bidaccept",
                  data: {requestid:requestid,acceptdetails:acceptdetails,_token: 'LmnW2p5nvlPNeVCzA9OXLmOKhnovxzVmAp2UsOkE'
},
                  type :"post",
                  success: function( data ) {
                    if(data){
                      window.location.reload();
                    }
                    
                  
                  }
          });
          return false;

  });
  $('.blocktrigger').click(function(){
        var requestid=$(this).data("request");
        var blockdetails=$("#detresx").val();
        console.log(requestid);
        console.log(blockdetails);
       
        $.ajax({
                  url: "../../ajax/bidblock",
                  data: {requestid:requestid,blockdetails:blockdetails,_token: 'LmnW2p5nvlPNeVCzA9OXLmOKhnovxzVmAp2UsOkE'
},
                  type :"post",
                  success: function( data ) {
                    if(data){
                      window.location.reload();
                    }
                    
                  
                  }
          });
          return false;

  });

</script>