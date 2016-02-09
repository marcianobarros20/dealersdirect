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
<script src="<?php echo url('/');?>/public/front_end/assets/jquery.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/assets/multiple-select.js"></script>

<link rel="stylesheet" href="<?php echo url('/');?>/public/front_end/assets/multiple-select.css" />
<script>
    $(function() {
        $('#ms').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });
</script>
<script>


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
                        url: "<?php echo url('/');?>/ajax/get_year",
                        data: {make_search:make_search,model_search:model_search,_token: '{!! csrf_token() !!}'},
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
        $("#trade-in").show();
      }
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

    $('#plsnex').click(function(){
      $("#firsc").hide();
      $("#secsc").show();
      return false;
    });

    $('#plstradenex').click(function(){
      $("#firsc").hide();
      $("#tradefirsc").hide();
      $("#secsc").show();
      return false;
    });

    $('#tradeinowenex').click(function(){
      $("#firsc").hide();
      $("#tradefirsc").show();
      $("#owediv").show();
      $("#secsc").hide();
      return false;
    });

    $('#tradeinnex').click(function(){
      $("#firsc").hide();
      $("#tradefirsc").show();
      $("#owediv").hide();
      $("#secsc").hide();
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
        $.ajax({
          url: "<?php echo url('/');?>/ajax/get_year",
          data: {make_search:trademake_search,model_search:trademodel_search,_token: '{!! csrf_token() !!}'},
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

    $('#npllses').click(function(){
        var tamo=$('#tamo').val();
        var mtamo=$('#mtamo').val();
        var chkone=0;
        var chktwo=0;
        var chkthree=0;
          if(!isNaN(tamo) && tamo!="")
          {
          
          }else{
            chkone+1;
            alert("Please Provide Total Amount");
            return false;
          }
          if(!isNaN(mtamo) && mtamo!="")
          {
          
          }else{
            chktwo+1;
            alert("Please Provide Monthly Amount");
            return false;
          }
          if(chkone==0 && chktwo==0 && (Number(tamo)>Number(mtamo))){
            $("#secsc").hide();
            $("#thirsc").show();
          }else{
            chkthree+1;
            alert("Please Make sure Total Amount Is Greater Than Monthly Amount");
            return false;
          }
        return false;
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
        var fname=$('#fname').val();
        console.log(fname);
        var lname=$('#lname').val();
        console.log(lname);
        var phone=$('#phone').val();
        console.log(phone);
        var email=$('#email').val();
        console.log(email);
        var zip=$('#zip').val();
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

});


</script>
