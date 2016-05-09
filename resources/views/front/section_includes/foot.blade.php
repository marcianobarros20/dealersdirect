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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/bootstrap.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/main.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/lib/jquery.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/lib/prism.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/jquery.selectric.js"></script>

<script>

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
          var tyx=1;
          $.ajax({
                            url: "<?php echo url('/');?>/ajax/get_condition",
                            data: {make_search:make_search,model_search:model_search,tyx:tyx,_token: '{!! csrf_token() !!}'},
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
        $('#tradeyear_search').change(function(){
          var year_search=$('#tradeyear_search').val();
          if(year_search!=""){
            $("#tradenext").show();
          }
        });
        $('#nextfirst').click(function(){
          

          var make_search=$('#make_search').val();
          console.log(make_search);
          var model_search=$('#model_search').val();
          console.log(model_search);
          var condition_search=$('#condition_search').val();
          console.log(condition_search);
          var year_search=$('#year_search').val();
          console.log(year_search);
          $.ajax({
            dataType: 'json',
            url: "<?php echo url('/');?>/ajax/getmsrp_range",
            data: {make_search:make_search,model_search:model_search,condition_search:condition_search,year_search:year_search,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if(data!=0){
                $("#minauto").html(data.min.base+"<br>"+data.min.monthly);
                $("#maxauto").html(data.max.base+"<br>"+data.max.monthly);
                $("#amortaization").show();
                $("#searchfirst").hide();
                $("#searchseconed").show();
                // alert(data);
                // $("#minauto").html(data.min.base);
                // $("#maxauto").html(data.max.base);
              }
              else{
                $("#amortaization").hide();
                 $("#searchfirst").hide();
                $("#searchseconed").show();
              }
            }
          });
          

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
        $('#backthird').click(function(){
          $("#searchthird").show();
          $("#searchfourth").hide();
          return false;
        });
        $('#backfifth').click(function(){
          $("#searchfourth").show();
          $("#searchfifth").hide();
          $("#fifthback").hide();
          $("#backfifth").hide();
          return false;
        });
        $('#third').click(function(){
          $("#searchthird").show();
          $("#searchfifth").hide();
          $("#fifthback").hide();
          $("#backfifth").hide();
          return false;
        });
        $('#fourthownext').click(function(){
          $("#searchthird").hide();
          $("#searchfourth").show();
          $("#owediv").show();
          return false;
        });
        $('#fourthnext').click(function(){
          $("#searchthird").hide();
          $("#searchfourth").show();
          $("#owediv").hide();
          $("#owediv").val('');
          return false;
        });
        $('#fifthnext').click(function(){
          $("#searchfourth").hide();
          $("#searchfifth").show();
          $("#backfifth").show();
          $("#fifthback").hide();
          return false;
        });
        $('#nextfifth').click(function(){
          $("#searchthird").hide();
          $("#searchfifth").show();
          $("#fifthback").show();
          $("#backfifth").hide();
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
    });
    $('#dstes').click(function(){
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
        var fname="";
        console.log(fname);
        var lname="";
        console.log(lname);
        var phone="";
        console.log(phone);
        var email="";
        console.log(email);
        var zip="";
        console.log(zip);
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

        $("#dvLoading").show();
          $.ajax({
                  url: "<?php echo url('/');?>/ajax/requirment_queue",
                  data: {
                          make_search:make_search,
                          model_search:model_search,
                          condition_search:condition_search,
                          year_search:year_search,
                          tamo:tamo,
                          mtamo:mtamo,
                          fname:fname,
                          lname:lname,
                          phone:phone,
                          email:email,
                          zip:zip,
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
                        var urlnew="<?php echo url('/');?>/request_success/"+data;
                        $(location).attr('href',urlnew);
                  }
          });
        return false;
    });
    $('#newdeset').click(function(){

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
      $("#dvLoading").show();
        $.ajax({
        url: "<?php echo url('/');?>/ajax/setto-signup",
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
                var urlnew="<?php echo url('/');?>/signin-client";
                $(location).attr('href',urlnew);
                }
        });
    return false;
    });


</script>
