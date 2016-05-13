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

          // var make_search=$('#make_search').val();
          // console.log(make_search);
          // var model_search=$('#model_search').val();
          // console.log(model_search);
          // var condition_search=$('#condition_search').val();
          // console.log(condition_search);
          // var year_search=$('#year_search').val();


          return false;
        });
        $('#backfirst').click(function(){
          $("#searchfirst").show();
          $("#searchseconed").hide();
          return false;
        });
        $('#nextsecond').click(function(){
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

			</script>