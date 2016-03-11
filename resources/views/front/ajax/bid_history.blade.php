<?php foreach ($BidQueue as $key => $bid) {
?>
<div class="comment clearfix">

    <div class="comment-wrap">

        <!-- content -->
        <div class="twelve columns">

            <div class="comment-meta">
                <p>
                    
                    <span class="icon-reply"></span>
                    <b>{!! $bid->dealers->first_name!!} {!! $bid->dealers->last_name!!}</b> {!! $bid->updated_at!!}
                    <?php if($bid->status==3){ ?><span class="label success">Accepted</span><?php } ?>
                    <?php if($bid->status==2){ ?><span class="label error">Rejected</span><?php } ?>
            </div>

            <div class="comment-content">
                <p><strong>Monthly:</strong>{!! $bid->monthly_amount !!}</p>
                <p><strong>Total:</strong>{!! $bid->total_amount !!}</p>
                <p><strong>Details:</strong>{!! $bid->details!!} ....</p>

            </div>
            <?php if($bid->visable==1 && $bid->request_queues->status!=1){ ?>
            <div id="at{!! $bid->id !!}">
                <a class="button medium full light openaccept" href="" data-request="{!! $bid->id !!}">
                    <span class="icon-checkmark"></span>Accept
                </a>
            </div>
            <div id="accep{!! $bid->id !!}" style="display:none;">
                <p>
                    <div class="textarea">
                        <textarea  id="accept{!! $bid->id !!}" placeholder="Accept Bid Details"></textarea>
                    </div>
                </p>
                <a href="#" data-request="{!! $bid->id !!}" class="button full light accepttrigger">
                    <span class="icon-checkmark"></span>Accept
                </a>
            </div>
            <div id="rj{!! $bid->id !!}">
                <a class="button medium full light openreject" href="" data-request="{!! $bid->id !!}">
                    <span class="icon-close"></span>Reject
                </a>
            </div>
            <div id="rejec{!! $bid->id !!}"  style="display:none;">
                <p>
                    <div class="textarea">
                        <textarea  id="reject{!! $bid->id !!}" placeholder="Reject Bid Details"></textarea>
                    </div>
                </p>
                <a href="#" data-request="{!! $bid->id !!}" class="button full light rejecttrigger">
                    <span class="icon-close"></span>Reject
                </a>
            </div>
            <div id="bl{!! $bid->id !!}">
                <a class="button medium full light openbloc" href="" data-request="{!! $bid->id !!}">
                    <span class="icon-blocked"></span>Block
                </a>
            </div>
            <div id="blc{!! $bid->id !!}" style="display:none;">
                <p>
                    <div class="textarea">
                        <textarea  id="bloc{!! $bid->id !!}" placeholder="Block Details"></textarea>
                    </div>
                </p>
                <a href="#" data-request="{!! $bid->id !!}" class="button full light blocktrigger">
                    <span class="icon-blocked"></span>Block
                </a>
            </div>
            <?php } ?>
        </div>
        <!-- .content -->
    </div>

</div>
<?php } ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/cross.js"></script> 
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
