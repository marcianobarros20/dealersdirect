<?php foreach ($BidQueue as $key => $Bidqueue) { ?>
                            <div class="comment clearfix">

                                <div class="comment-wrap">

                                    

                                    <!-- content -->
                                    <div class="twelve columns">

                                        <div class="comment-meta">
                                            <p>
                                                <a href="#">
                                                    <span class="icon-reply"></span>
                                                </a>
                                                <b>{!! $Bidqueue->dealers->first_name!!} {!! $Bidqueue->dealers->last_name!!}</b> 2 days ago
                                                <?php if($Bidqueue->status==3){ ?><span class="label success">Accepted</span><?php } ?>
                                                <?php if($Bidqueue->status==2){ ?><span class="label error">Rejected</span><?php } ?>
                                            </p>

                                        </div>

                                        <div class="comment-content">
                                            <p><strong>Monthly:</strong>{!! $Bidqueue->monthly_amount !!}</p>
                                            <p><strong>Total:</strong>{!! $Bidqueue->total_amount !!}</p>
                                            <p><strong>Details:</strong>{!! substr( $Bidqueue->details, 0, strrpos( substr( $Bidqueue->details, 0, 55), ' ' ) ) !!} ....</p>
                                                <a data-effect="mfp-zoom-out" class="popup-modal button medium full light" href="#test-popup{!! $Bidqueue->id !!}">
                                                <span class="icon-eye2"></span>View</a>
                                                <div id="test-popup{!! $Bidqueue->id !!}" class="white-popup mfp-hide" data-effect="mfp-zoom-out">
                                                    <h3><b>{!! $Bidqueue->dealers->first_name!!} {!! $Bidqueue->dealers->last_name!!} Bid</b>
                                                    </h3>
                                                        <p><strong>Monthly:</strong>{!! $Bidqueue->monthly_amount !!}</p>
                                                        <p><strong>Total:</strong>{!! $Bidqueue->total_amount !!}</p>
                                                        <p><strong>Details:</strong>{!! $Bidqueue->details !!}</p>
                                                </div>
                                                <?php if($Bidqueue->status==0 && $RequestQueue_row->status==0){?>
                                                <a data-effect="mfp-zoom-out" class="popup-modal button medium full light" href="#test-accept-popup{!! $Bidqueue->id !!}">
                                                <span class="icon-checkmark"></span>Accept</a>
                                                <div id="test-accept-popup{!! $Bidqueue->id !!}" class="white-popup mfp-hide" data-effect="mfp-zoom-out">
                                                    <h3><b>Accept Bid Of {!! $Bidqueue->dealers->first_name!!} {!! $Bidqueue->dealers->last_name!!} </b>
                                                    </h3>
                                                        <p><strong>Monthly:</strong>{!! $Bidqueue->monthly_amount !!}</p>
                                                        <p><strong>Total:</strong>{!! $Bidqueue->total_amount !!}</p>
                                                        <p><strong>Details:</strong>{!! $Bidqueue->details !!}</p>
                                                        <p><div class="textarea"><textarea  id="accept{!! $Bidqueue->id !!}" placeholder="Accept Bid Details"></textarea></div></p>
                                                        <a href="#" data-request="{!! $Bidqueue->id !!}" class="button full light accepttrigger">Accept</a>
                                                </div>
                                                <a data-effect="mfp-zoom-out" class="popup-modal button medium full light" href="#test-reject-popup{!! $Bidqueue->id !!}">
                                                <span class="icon-close"></span>Reject</a>
                                                <div id="test-reject-popup{!! $Bidqueue->id !!}" class="white-popup mfp-hide" data-effect="mfp-zoom-out">
                                                    <h3><b>Reject Bid Of {!! $Bidqueue->dealers->first_name!!} {!! $Bidqueue->dealers->last_name!!} </b>
                                                    </h3>
                                                        <p><strong>Monthly:</strong>{!! $Bidqueue->monthly_amount !!}</p>
                                                        <p><strong>Total:</strong>{!! $Bidqueue->total_amount !!}</p>
                                                        <p><strong>Details:</strong>{!! $Bidqueue->details !!}</p>
                                                        <p><div class="textarea"><textarea id="reject{!! $Bidqueue->id !!}" placeholder="Reject Bid Details"></textarea></div></p>
                                                        <a href="#" data-request="{!! $Bidqueue->id !!}" class="button full light rejecttrigger">Reject</a>
                                                </div>
                                                <?php } ?>

                                        </div>

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



});

</script>