




<!-- ================================================== BOTTOM FOOTER ================================================== -->
<div id="dvLoading" style="display:none;"><img  style="position: absolute; height:80%;margin: auto; top: 0;left: 0; right: 0;  bottom: 0;" src="{{ url('/')}}/public/front/images/loader.gif"></div>
<footer>
      <div class="bottom-footer clearfix;">
    <div class="container">
          <div class="row">
        <div class="six columns">
              <div class="copyrights">
            <p>&copy; 2016 - DealersDirect. All rights reserved.</p>

          </div>
            </div>
        <div class="six columns">
              <div class="footer-navigation">
                <ul class="clearfix">
                  <li><a href="<?php echo url('/');?>" class="active">Home</a> </li>
                  <li><a href="">About</a> </li>
                  <li><a href="">Services</a> </li>
                  <li><a href="">Contact</a> </li>
                  <li><a href="">Terms &amp; Conditions</a> </li>
                  <li><a href="">Privacy Policy</a> </li>
                </ul>
                <p><a href="http://www.edmunds.com/?id=meth499r2aepx8h7c7hcm9qz"><img src="<?php echo url('/');?>/public/front/images/100_horizontal_grey.png"></a></p>
          </div>
            </div>
      </div>
        </div>
  </div>
    </footer>
<!-- ================================================== BOTTOM FOOTER ================================================== --> 

<!-- ================================================== TO TOP ================================================== -->
<div class="to-top"> <a href="#"> <span class="icon-arrow-up"></span> </a> </div>
<!-- ================================================== TO TOP ================================================== --> 

<!-- Javascript
================================================== --> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.dscountdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/chosen.jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.themepunch.plugins.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.themepunch.revolution.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/easyResponsiveTabs.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.appear.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.magnific-popup.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.knob.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/retina-1.1.0.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/jquery.mapmarker.js"></script> 
<script type="text/javascript" src="<?php echo url('/');?>/public/front/js/custom.js"></script> 

<!-- End Document================================================== -->
<style type="text/css">
  #dvLoading
{
   background:#000  no-repeat center center;
   opacity: 0.8;
    overflow-x: hidden;
    overflow-y: auto;
    height: 100%;
    left: 0;
    outline: medium none !important;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1043;
}
</style>
<script>

$(document).ready(function(){

  //alert("hi");
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
                          $("#model_search").trigger("chosen:updated");;

                        }
                        }
                        });
                    $.ajax({
                        url: "<?php echo url('/');?>/ajax/get_year",
                        data: {make_search:make_search,model_search:0,_token: '{!! csrf_token() !!}'},
                        type :"post",
                        success: function( data ) {
                        if (make_search!='' && data!=""){
                          $("#year_search").html('');
                            $("#year_search").html(data); 
                          $("#year_search").trigger("chosen:updated");;

                        }
                        }
                        });


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
                          $("#trademodel_search").trigger("chosen:updated");;

                        }
                        }
                        });
                    $.ajax({
                        url: "<?php echo url('/');?>/ajax/get_year",
                        data: {make_search:trademake_search,model_search:0,_token: '{!! csrf_token() !!}'},
                        type :"post",
                        success: function( data ) {
                        if (trademake_search!='' && data!=""){
                          $("#tradeyear_search").html('');
                            $("#tradeyear_search").html(data); 
                          $("#tradeyear_search").trigger("chosen:updated");;

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
                          $("#tradeyear_search").trigger("chosen:updated");;

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
                          $("#year_search").trigger("chosen:updated");;

                        }
                        }
                        });


});
$('#tradeyear_search').change(function(){
  var year_search=$('#tradeyear_search').val();
  if(year_search!=""){
    //$("#nextis").show();
    $("#tradenext").show();

  }

});
$('#year_search').change(function(){
  var year_search=$('#year_search').val();
  if(year_search!=""){
    //$("#nextis").show();
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
$('#npllses').click(function(){
  var tamo=$('#tamo').val();
  var mtamo=$('#mtamo').val();
  
  var chkone=0;
  var chktwo=0;
  var chkthree=0;

          if(!isNaN(tamo) && tamo!="")
        {
           //do some thing if it's a number
        }else{
           chkone+1;
           alert("Please Provide Total Amount");
           return false;
        }
        if(!isNaN(mtamo) && mtamo!="")
        {
           //do some thing if it's a number
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
    // return false;
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

});

</script>
</body>
</html>
