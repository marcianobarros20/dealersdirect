<?php foreach ($BidQueue as $key => $bid) {
?>
<div class="comment clearfix">

    <div class="comment-wrap">

        <!-- content -->
        <div class="twelve columns">
            <?php $keys=0;
            foreach ($bid->bid_image as $key => $bid_image){

              if($bid_image->dealer_id==$bid->dealer_id){
              $keys++;
            ?>
            <div class="comment-avatar">
              <a href="#">
                <img src="<?php echo url('/');?>/public/uploads/project/thumb/{!! $bid_image->image!!}" title="car" alt="car" />
              </a>
            </div>
            <?php
                }
               }
             ?>
            <div class="comment-meta">
                <p>
                    
                    <span class="icon-reply"></span>
                    <b>{!! $bid->dealers->first_name!!} {!! $bid->dealers->last_name!!}</b> {!! $bid->updated_at!!}
                    @if($bid->status==3)
                    <span class="label success">Accepted</span>
                    @endif
                    @if($bid->status==2)
                    <span class="label error">Rejected</span>
                    @endif
                                        @if($bid->visable==1 && $bid->blocked!=1 && $bid->status!=2)

                                        <button type="button" class="btn btn-success">Visible</button>
                                        @endif
                                        @if($bid->status==2)

                                        <button type="button" class="btn btn-warning">Rejected</button>
                                        @endif
                                        @if($bid->status==3)

                                        <button type="button" class="btn btn-info">Accepted</button>
                                        @endif
                                        @if($bid->blocked==1)
                                        <button type="button" class="btn btn-danger">Blocked</button>
                                        @endif
            </div>

            <div class="comment-content">
                <p><strong>Monthly:</strong><?php $DoubleMonthly=floatval($bid->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></p>
                <p><strong>Total:</strong><?php $DoubleTotal=floatval($bid->total_amount);echo "$".number_format($DoubleTotal,2);?></p>
                @if($bid->trade_in!=0)
                <p><strong>Trade In:</strong><?php $DoubleTrade_in=floatval($bid->trade_in);echo "$".number_format($DoubleTrade_in,2);?></p>
                @endif
                <p><strong>Details:</strong>{!! $bid->details!!} ....</p>
                

            </div>
            
        </div>
        <!-- .content -->
    </div>

</div>
<?php } ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/cross_dealers.js"></script> 
<script>

$(document).ready(function(){

  $('.rejecttrigger').click(function(){
          var requestid=$(this).data("request");
          var rejectdetails=$("#reject"+requestid).val();
          console.log(requestid);
          console.log(rejectdetails);
          $.ajax({
                  url: "<?php echo url('/');?>/ajax/bidreject",
                  data: {requestid:requestid,rejectdetails:rejectdetails,_token: '{!! csrf_token() !!}'},
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
          var acceptdetails=$("#accept"+requestid).val();
          console.log(requestid);
          console.log(acceptdetails);
          $.ajax({
                  url: "<?php echo url('/');?>/ajax/bidaccept",
                  data: {requestid:requestid,acceptdetails:acceptdetails,_token: '{!! csrf_token() !!}'},
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
        var blockdetails=$("#bloc"+requestid).val();
        console.log(requestid);
        console.log(blockdetails);
        $.ajax({
                  url: "<?php echo url('/');?>/ajax/bidblock",
                  data: {requestid:requestid,blockdetails:blockdetails,_token: '{!! csrf_token() !!}'},
                  type :"post",
                  success: function( data ) {
                    if(data){
                      window.location.reload();
                    }
                    
                  
                  }
          });
          return false;

  });

    $('.openreject').click(function(){
         var requestid=$(this).data("request");
         
         $("#accep"+requestid).hide();
         $("#at"+requestid).show();
         $("#rj"+requestid).hide();
         $("#rejec"+requestid).show();
         $("#bl"+requestid).show();
         $("#blc"+requestid).hide();
         return false;
    });
    $('.openaccept').click(function(){
         var requestid=$(this).data("request");
         
         $("#rejec"+requestid).hide();
         $("#rj"+requestid).show();
         $("#at"+requestid).hide();
         $("#accep"+requestid).show();
         $("#bl"+requestid).show();
         $("#blc"+requestid).hide();
         return false;
    });
    
    $('.openbloc').click(function(){
         var requestid=$(this).data("request");
         
         $("#rejec"+requestid).hide();
         $("#rj"+requestid).show();
         $("#at"+requestid).show();
         $("#accep"+requestid).hide();

         $("#bl"+requestid).hide();
         $("#blc"+requestid).show();
         return false;
    });


});

</script>
