<style>
#dvLoading{
  background: #000 none no-repeat scroll center center;
    height: 100%;
    left: 0;
    opacity: 0.8;
    outline: medium none !important;
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1043;
}
</style>
<div id="dvLoading" style="display:none; "><img  style="position: absolute; height:80%;margin: auto; top: 0;left: 0; right: 0;  bottom: 0;" src="{{ url('/')}}/public/front/images/loader.gif"></div>

<script src="<?php echo url('/');?>/public/front_end/js/bootstrap.min.js"></script>

      <script src="<?php echo url('/');?>/public/front_end/selectrick/lib/jquery.min.js"></script>
      <script src="<?php echo url('/');?>/public/front_end/selectrick/lib/prism.js"></script>
      <script src="<?php echo url('/');?>/public/front_end/selectrick/jquery.selectric.js"></script>
      <script src="<?php echo url('/');?>/public/front_end/js/ajaxcaravanclient.js"></script>
      <!--Price format js-->
      <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
      <script src="<?php echo url('/');?>/public/front_end/js/jquery.price_format.2.0.min.js"></script>
      <!--Price format js-->
      <script>
      $(function() {
        $('select, .select').selectric();

        $('.customOptions').selectric({
        optionsItemBuilder: function(itemData, element, index) {
                  return element.val().length ? '<span class="ico ico-' + element.val() +  '"></span>' + itemData.text : itemData.text;
                  }
      });

      $('.customLabel').selectric({
        labelBuilder: function(currItem) {
                return '<strong><em>' + currItem.text + '</em></strong>';
                }
        });
      });

      $(function() {
            $('select, .select').selectric();
      });

$(document).ready(function(){
        $('#make_search').change(function(){
                        var make_search=$('#make_search').val();
                        $.ajax({
                            url: "<?php echo url('/');?>/ajax/get_model",
                            data: {make_search:make_search,_token: '{!! csrf_token() !!}'},
                            type :"post",
                            success: function( data ) {
                              if (make_search!='' && data!=""){
                                $("#model_search").html('');
                                $("#model_search").html(data);
                                $("#model_search").selectric(); 
                              }
                            }
                        });
        });
        $('#model_search').change(function(){
          var make_search=$('#make_search').val();
          var model_search=$('#model_search').val();
          
          $.ajax({
                            url: "<?php echo url('/');?>/ajax/get_condition",
                            data: {make_search:make_search,model_search:model_search,_token: '{!! csrf_token() !!}'},
                            type :"post",
                            success: function( data ) {
                                if (make_search!='' && data!="" && model_search!=""){
                                    $("#condition_search").html('');
                                    $("#condition_search").html(data); 
                                    $("#condition_search").selectric();
                                }
                            }
                  });
        });
        $('#condition_search').change(function(){
          var make_search=$('#make_search').val();
          var model_search=$('#model_search').val();
          var condition_search=$('#condition_search').val();
          $.ajax({
                            url: "<?php echo url('/');?>/ajax/get_year",
                            data: {make_search:make_search,model_search:model_search,condition_search:condition_search,_token: '{!! csrf_token() !!}'},
                            type :"post",
                            success: function( data ) {
                                if (make_search!='' && data!=""){
                                    $("#year_search").html('');
                                    $("#year_search").html(data); 
                                    $("#year_search").selectric();
                                }
                            }
                  });
        });
        $('#year_search').change(function(){
          var year_search=$('#year_search').val();
          if(year_search!=""){
            $("#searchfirstnext").show();
          }
        });
        $('#nextfirst').click(function(){
          $("#searchfirst").hide();
          $("#searchseconed").show();
          $("#minauto").hide();
          $("#maxauto").hide();

          var make_search=$('#make_search').val();
          console.log(make_search);
          var model_search=$('#model_search').val();
          console.log(model_search);
          var condition_search=$('#condition_search').val();
          console.log(condition_search);
          var year_search=$('#year_search').val();
          
/* *********************************************************
NEW JQUERY CODE ADDED IN CLIENT SIDE BEGIN 
***********************************************************/

          var interest_rate = $('#rateofinterest').val();
          console.log(interest_rate);
          var loan_term = $('#terms').val();
          console.log(loan_term);
          $("#dvLoading").show();











          $.ajax({
            dataType: 'json',
            url: "<?php echo url('/');?>/ajax/getmsrp_range",
            data: {make_search:make_search,model_search:model_search,condition_search:condition_search,year_search:year_search,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              

               $("#dvLoading").hide();
              if(data!=0){

                $("#minauto").show();
                $("#maxauto").show();


                //Calculate Value on base of Minimum Amount Custom Interest Rate Begin
    var months= loan_term*12;
        var rate_of_interest=(interest_rate/100)/12;
        var up=rate_of_interest*Math.pow((rate_of_interest+1),months);
        var down=(Math.pow((rate_of_interest+1),months))-1;
        var top_min_monthly_rate=parseFloat(numeral(data.min.base).format('00.00')*(up/down)).toFixed(2);

    //END


    //Calculate Value on base of Maximum Amount Custom Interest Rate Begin
    var months= loan_term*12;
        var rate_of_interest=(interest_rate/100)/12;
        var up=rate_of_interest*Math.pow((rate_of_interest+1),months);
        var down=(Math.pow((rate_of_interest+1),months))-1;
        var top_max_monthly_rate=parseFloat(numeral(data.max.base).format('00.00')*(up/down)).toFixed(2);

    //END





                /*  $("#minauto").html("Minimum Price<br>"+"Total : "+numeral(data.min.base).format('$0,0.00')+"<br>"+"Monthly : "+numeral(data.min.monthly).format('$0,0.00'));
                $("#maxauto").html("Maximum Price<br>"+"Total : "+numeral(data.max.base).format('$0,0.00')+"<br>"+"Monthly : "+numeral(data.max.monthly).format('$0,0.00'));
                */

                $("#minauto").html("Minimum Price<br>"+"Total : "+numeral(data.min.base).format('$0,0.00')+"<br>"+"Monthly : $"+top_min_monthly_rate);
                $("#maxauto").html("Maximum Price<br>"+"Total : "+numeral(data.max.base).format('$0,0.00')+"<br>"+"Monthly : $"+top_max_monthly_rate);

                $("#disclaimer_data").html("*Amount shown as "+interest_rate+"% interest per year for " +loan_term +" years.");
                $('#toto').html('<input type="hidden" id="min_amt" name="min_amt" value="'+numeral(data.min.base).format('00.00')+'"><input type="hidden" id="max_amt" name="max_amt" value="'+numeral(data.max.base).format('00.00')+'">');
                $("#minmsrp").html(numeral(data.min.base).format('$0,0.00'));
                $("#maxmsrp").html(numeral(data.max.base).format('$0,0.00'));
                $("#minmp").html(numeral(data.min.monthly).format('$0,0.00'));
                $("#maxmp").html(numeral(data.max.monthly).format('$0,0.00')); 
                $("#fmp").show();
                $("#fmsrfp").show();
                getimageedmunds(make_search,model_search,condition_search,year_search,1);
                
              }
              else{
                $("#fmp").hide();
                $("#fmsrfp").hide();
                $("#minmsrp").html('');
                $("#maxmsrp").html('');
                $("#minmp").html('');
                $("#maxmp").html('');
                getimageedmunds(make_search,model_search,condition_search,year_search,0);
                 $("#minauto").hide();
                $("#maxauto").hide();
                
              }
            }
          });


           // Insert Record from FUEl to DB Begin


         $.ajax({
            //dataType: 'json',
            url: "<?php echo url('/');?>/ajax/addFuelImagesproducts",
            data: {make_search:make_search,model_search:model_search,condition_search:condition_search,year_search:year_search,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
            
            $("#dvLoading").hide();
            //$(".fueldb").html(data);

            console.log(data);
              }
            });

      


          // Fuel Api End

/* *********************************************************
NEW JQUERY CODE ADDED IN CLIENT SIDE END
***********************************************************/

          return false;
        });
        $('#backfirst').click(function(){
          $("#searchfirst").show();
          $("#searchseconed").hide();
          return false;
        });
        $('#nextsecond').click(function(){

          var minmsrp =parseFloat($("#minmsrp").html());
          var maxmsrp =parseFloat($("#maxmsrp").html());
          var minmp=parseFloat($("#minmp").html());
          var maxmp=parseFloat($("#maxmp").html());
          var tamo=parseFloat($("#tamo").val());
          var mtamo=parseFloat($("#mtamo").val());
          if((isNaN(tamo) || tamo=="") ){
              alert("Sorry Please fill The Total Amount");
              return false;
            }
            if((isNaN(mtamo) || mtamo=="")){
              alert("Sorry Please Fill The Monthly Amount");
              return false;
            }
            if(minmsrp!="" && maxmsrp!="" && minmp!="" && maxmp!="" && tamo!="" && mtamo!="" ){
                if(tamo<minmsrp){

                  $("#tb").html(numeral(tamo.toFixed( 2 )).format('$0,0.00'));
                  
                  $("#tb").removeClass("value-green");
                  $("#tb").addClass("value-red");
                  $("#tttb").html("Total budget Is Less than MSRP Range");
                }else{
                  $("#tb").html(numeral(tamo.toFixed( 2 )).format('$0,0.00'));
                  $("#tb").removeClass("value-red");
                  $("#tb").addClass("value-green");
                  $("#tttb").html("Total budget Is With In The MSRP Range");
                }
                if(mtamo<minmp){
                  $("#mb").html(numeral(mtamo.toFixed( 2 )).format('$0,0.00'));  
                  $("#mb").removeClass("value-green");
                  $("#mb").addClass("value-red");
                  $("#ttmb").html("Monthly budget Is Less than Monthly Range");
                }else{
                  $("#mb").html(numeral(mtamo.toFixed( 2 )).format('$0,0.00'));
                  $("#mb").removeClass("value-red");
                  $("#mb").addClass("value-green");
                  $("#ttmb").html("Monthly budget Is With In The Monthly Range");
                }
            }
            else{
              
              
              $("#tb").html(numeral(tamo.toFixed( 2 )).format('$0,0.00'));
              $("#mb").html(numeral(mtamo.toFixed( 2 )).format('$0,0.00'));
            }
          $("#searchseconed").hide();
          $("#searchthird").show();
          return false;
        });
        $('#backsecond').click(function(){
          $("#searchseconed").show();
          $("#searchthird").hide();
          return false;
        });
        $("input:radio[name=tradein]").click(function() {
          var value = $(this).val();
          if(value=="yes"){
            $("#owe-money").show();
            $("#nextis").hide();
            $("#tradein").hide();
            $("#tradeinowe").hide();
          }else{
            $("#owe-money").hide();
            $("#nextis").show();
            $("#tradein").hide();
            $("#tradeinowe").hide();
          }
        });
        $("input:radio[name=owe]").click(function() {
          var owe = $(this).val();
          if(owe=="1"){
            $("#tradeinowe").show();
            $("#tradein").hide();
            $("#nextis").hide();
          }else{
            $("#tradein").show();
            $("#tradeinowe").hide();
            $("#nextis").hide();
          }
        });
        $("#nextfifth").click(function() {
            $("#dvLoading").show();
            var make_search=$('#make_search').val();
            console.log(make_search);
            var model_search=$('#model_search').val();
            console.log(model_search);
            var condition_search=$('#condition_search').val();
            console.log(condition_search);
            var year_search=$('#year_search').val();
            console.log(year_search);
            var tamo=$('#tamo').val();
            console.log(tamo);
            var mtamo=$('#mtamo').val();
            console.log(mtamo);
            var tradein=$('input[name=tradein]:checked').val();
            console.log(tradein);
            var owe=$('input[name=owe]:checked').val();
            console.log(owe);
            var oweamount=$('#oweamount').val();
            console.log(oweamount);
            var trademake_search=$('#trademake_search').val();
            console.log(trademake_search);
            var trademodel_search=$('#trademodel_search').val();
            console.log(trademodel_search);
            var tradecondition_search=$('#tradecondition_search').val();
            console.log(tradecondition_search);
            var tradeyear_search=$('#tradeyear_search').val();
            console.log(tradeyear_search);
              $.ajax({
                          url: "<?php echo url('/');?>/ajax/client-request",
                          data: {
                                  make_search:make_search,
                                  model_search:model_search,
                                  condition_search:condition_search,
                                  year_search:year_search,
                                  tamo:tamo,
                                  mtamo:mtamo,
                                  tradein:tradein,
                                  owe:owe,
                                  oweamount:oweamount,
                                  trademake_search:trademake_search,
                                  trademodel_search:trademodel_search,
                                  tradecondition_search:tradecondition_search,
                                  tradeyear_search:tradeyear_search,                                
                                  _token: '{!! csrf_token() !!}'
                          },
                          type :"post",
                          success: function( data ) {
                            var urlnew="<?php echo url('/');?>/client/request_detail/"+data;
                          $(location).attr('href',urlnew);
                          }
                      });
              return false;
            });
        $('#fourthnext').click(function(){
          $("#searchthird").hide();
          $("#searchfourth").show();
          $("#owediv").hide();
          $("#owediv").val('');
          return false;
        });
        $('#backthird').click(function(){
          $("#searchthird").show();
          $("#searchfourth").hide();
          return false;
        });
        $('#fourthownext').click(function(){
          $("#searchthird").hide();
          $("#searchfourth").show();
          $("#owediv").show();
          return false;
        });
        $('#sinses').click(function(){
              $("#dvLoading").show();
              var make_search=$('#make_search').val();
              console.log(make_search);
              var model_search=$('#model_search').val();
              console.log(model_search);
              var condition_search=$('#condition_search').val();
              console.log(condition_search);
              var year_search=$('#year_search').val();
              console.log(year_search);
              var tamo=$('#tamo').val();
              console.log(tamo);
              var mtamo=$('#mtamo').val();
              console.log(mtamo);
              var tradein=$('input[name=tradein]:checked').val();
              console.log(tradein);
              var owe=$('input[name=owe]:checked').val();
              console.log(owe);
              var oweamount=$('#oweamount').val();
              console.log(oweamount);
              var trademake_search=$('#trademake_search').val();
              console.log(trademake_search);
              var trademodel_search=$('#trademodel_search').val();
              console.log(trademodel_search);
              var tradecondition_search=$('#tradecondition_search').val();
              console.log(tradecondition_search);
              var tradeyear_search=$('#tradeyear_search').val();
              console.log(tradeyear_search);
                $.ajax({
                    url: "<?php echo url('/');?>/ajax/client-request",
                    data: {
                        make_search:make_search,
                        model_search:model_search,
                        condition_search:condition_search,
                        year_search:year_search,
                        tamo:tamo,
                        mtamo:mtamo,
                        tradein:tradein,
                        owe:owe,
                        oweamount:oweamount,
                        trademake_search:trademake_search,
                        trademodel_search:trademodel_search,
                        tradecondition_search:tradecondition_search,
                        tradeyear_search:tradeyear_search,                                
                        _token: '{!! csrf_token() !!}'
                    },
                    type :"post",
                    success: function( data ) {
                        var urlnew="<?php echo url('/');?>/client/request_detail/"+data;
                        $(location).attr('href',urlnew);
                    }
                });
              return false;
        });
        $('#trademake_search').change(function(){
          var trademake_search=$('#trademake_search').val();
          $.ajax({
            url: "<?php echo url('/');?>/ajax/get_model",
            data: {make_search:trademake_search,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if (trademake_search!='' && data!=""){
                $("#trademodel_search").html('');
                $("#trademodel_search").html(data); 
                $("#trademodel_search").selectric(); 
              }
            }
          });
        });
        $('#trademodel_search').change(function(){
          var trademake_search=$('#trademake_search').val();
          var trademodel_search=$('#trademodel_search').val();
          var tyx=2;
          $.ajax({
            url: "<?php echo url('/');?>/ajax/get_condition",
            data: {make_search:trademake_search,model_search:trademodel_search,tyx:tyx,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if (make_search!='' && data!="" && model_search!=""){
                $("#tradecondition_search").html('');
                $("#tradecondition_search").html(data); 
                $("#tradecondition_search").selectric();
              }
            }
          });
        });
        $('#tradecondition_search').change(function(){
          var trademake_search=$('#trademake_search').val();
          var trademodel_search=$('#trademodel_search').val();
          var tradecondition_search=$('#tradecondition_search').val();
          $.ajax({
            url: "<?php echo url('/');?>/ajax/get_year",
            data: {make_search:trademake_search,model_search:trademodel_search,condition_search:tradecondition_search,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if (trademake_search!='' && data!=""){
                $("#tradeyear_search").html('');
                $("#tradeyear_search").html(data); 
                $("#tradeyear_search").selectric();
              }
            }
          });
        });
        $('#tradeyear_search').change(function(){
          var year_search=$('#tradeyear_search').val();
          if(year_search!=""){
            $("#tradenext").show();
          }
        });
      $('.add_style').click(function(){
            var requestid=$(this).data("id");
            var styleid=$(this).data("styleid");
            $("#dvLoading").show();
              $.ajax({
                url: "<?php echo url('/');?>/ajax/addstyletorequestqueue",
                data: {requestid:requestid,styleid:styleid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  var newurl="<?php echo url('/');?>/client/add-engine/"+btoa(data);
                  $(location).attr('href', newurl);
                }
              });
            return false;
      });
      $('.add_engine').click(function(){
          var requestid=$(this).data("id");
          var engineid=$(this).data("engineid");
          var count=$(this).data("count");
              $.ajax({
                  url: "<?php echo url('/');?>/ajax/addenginetorequestqueue",
                  data: {requestid:requestid,engineid:engineid,count:count,_token: '{!! csrf_token() !!}'},
                  type :"post",
                  success: function( data ) {
                      var newurl="<?php echo url('/');?>/client/add-transmission/"+btoa(data);
                      $(location).attr('href', newurl);
                  }
              });
          return false;
      });
      $('.add_transmission').click(function(){
            var requestid=$(this).data("id");
            var transmissionid=$(this).data("transmissionid");
            var count=$(this).data("count");
                $.ajax({
                    url: "<?php echo url('/');?>/ajax/addtranstorequestqueue",
                    data: {requestid:requestid,transmissionid:transmissionid,count:count,_token: '{!! csrf_token() !!}'},
                    type :"post",
                    success: function( data ) {
                        var newurl="<?php echo url('/');?>/client/add-color-exterior/"+btoa(data);
                        $(location).attr('href', newurl);
                    }
                });
            return false;
      });
      $('.add_exterior_color').click(function(){
          var requestid=$(this).data("id");
          var colorid=$(this).data("colorid");
          var count=$(this).data("count");
              $.ajax({
                    url: "<?php echo url('/');?>/ajax/addexcolortorequestqueue",
                    data: {requestid:requestid,colorid:colorid,count:count,_token: '{!! csrf_token() !!}'},
                    type :"post",
                    success: function( data ) {
                        var newurl="<?php echo url('/');?>/client/add-color-interior/"+btoa(data);
                        $(location).attr('href', newurl);
                    }
              });
          return false;
      });
      $('.add_interior_color').click(function(){
          var requestid=$(this).data("id");
          var colorid=$(this).data("colorid");
          var count=$(this).data("count");
            $.ajax({
                url: "<?php echo url('/');?>/ajax/addincolortorequestqueue",
                data: {requestid:requestid,colorid:colorid,count:count,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  var newurl="<?php echo url('/');?>/client/request_detail/"+data;
                  $(location).attr('href', newurl);
                }
            });
          return false;
      });


      
});

//..Ajax Fuel API Gallery Loading 
$(document).ready(function(){
  $('.vechilesOptions').click(function(){
            //e.preventDefault();
            var SelectedOption = $(this).text();
            if(SelectedOption=="Details")
            {
              $(".DefaultGallery").show();
              $("#OptionsGallery").hide();
            }
            else{
            var OptionKey= SelectedOption.replace( /[^\d\.]*/g, '');
                var trimNameValue = $("#trim_name"+OptionKey).val();
                var bodyNameValue = $("#body_name"+OptionKey).val();
                var requestid = $('#requestid').val();
              $.ajax({
                  url: "<?php echo url('/');?>/client/request_detail_options/"+requestid,
                  data: {'requestid':requestid,'trim_name':trimNameValue, 'body_name': bodyNameValue,'OptionNumber':OptionKey},
                  //dataType: 'json',
                 
                  type :"get",
                  success: function(data){
                  //console.log(data);
                  $("#OptionsGallery").show();
                  $("#OptionsGallery").html(data);
                  $(".DefaultGallery").hide();
                },

                 error: function() {
                        //alert('Not OKay');
                        $(".DefaultGallery").show();
                        $("#OptionsGallery").hide();
                   }
              
              });
            }
      });
});


//Bid Accept and Reject Feature



  
      $(".acceptBid").click(function(e){

        //alert($(this).data("id"));
        e.preventDefault();
        var requestid =  $(this).data("id");
        var dealerid = $("#dealerid").val();
        var acceptdetails = "Accept";
        $.ajax({
          url:"<?php echo url('/');?>/ajax/bidacceptnew/"+requestid+"/"+dealerid,
          data:{'requestid':requestid, 'dealerid':dealerid, 'acceptdetails': acceptdetails},
          type:"post",
          success: function(data){
            console.log(data);
            $('.bidstatusresults').html(data);
           location.reload(true);
           
          },
          error:function(){
            console.log("error in accept action");
          }

        });
        

      });

      $(".rejectBid").click(function(e){

        //alert($(this).data("id"));
        e.preventDefault();
        var requestid =  $(this).data("id");
        var dealerid = $("#dealerid").val();
        var rejectdetails = "Reject";

          $.ajax({
            url:"<?php echo url('/'); ?>/ajax/bidrejectafteraccept/"+requestid+"/"+dealerid,
            data:{'requestid':requestid, 'dealerid':dealerid, 'rejectdetails':rejectdetails},
            type:"post",
            success:function(data){
              console.log("Reject");
              $('.bidstatusresults').html(data);
              //location.reload(true);
              window.location.href = "<?php echo url('/'); ?>/client/contact_list";
            },
            error:function(){
              console.log("error in reject action");
              
            }

          });

      });

      $(".finalizeBid").click(function(e){
        e.preventDefault();
        //alert($(this).data("id"));
        var requestid = $(this).data("id");
        var dealerid = $("#dealerid").val();
        var finalizedetails="Sale";
          $.ajax({
            url:"<?php echo url('/'); ?>/ajax/bidfinalize/"+requestid+"/"+dealerid,
            data:{'requestid' : requestid, 'dealerid':dealerid, 'finalizedetails' : finalizedetails},
            type:"post",
            success:function(data){
              console.log("Sale");
              $('.bidstatusresults').html(data);
              //location.reload(true);
              $(".finalizeBid").hide();
              $('.rejectBidfinal').hide();
             window.location.href = "<?php echo url('/'); ?>/client/contact_list";
            },
            error:function(){
              console.log("error in finalize action");
            }

          });
      });

      $(".rejectBidfinal").click(function(e){
        e.preventDefault();
        //alert($(this).data("id"));
        var requestid = $(this).data("id");
        var dealerid = $("#dealerid").val();
        var failuredetails="Loss Sale";
          $.ajax({
            url:"<?php echo url('/'); ?>/ajax/bidrejectfinal/"+requestid+"/"+dealerid,
            data:{'requestid' : requestid, 'dealerid':dealerid, 'failuredetails' : failuredetails},
            type:"post",
            success:function(data){
              console.log("Loss Sale");
              //location.reload(true);
              $(".finalizeBid").hide();
              $('.rejectBidfinal').hide();
              window.location.href = "<?php echo url('/'); ?>/client/contact_list";
                          },
            error:function(){
              console.log("error in finalize action");
            }

          });
      });


      </script>