




<!-- ================================================== BOTTOM FOOTER ================================================== -->
<footer>
      <div class="bottom-footer clearfix;">
    <div class="container">
          <div class="row">
        <div class="six columns">
              <div class="copyrights">
            <p>&copy; 2016 - DEALERSDIRECT.</p>
          </div>
            </div>
        <div class="six columns">
              <div class="footer-navigation">
                <ul class="clearfix">
                  <li><a href="<?php echo url('/');?>/client-dashboard" class="active">Dashboard</a> </li>
                  <li><a href="<?php echo url('/');?>/client/profile">Profile</a> </li>
                  <li><a href="<?php echo url('/');?>/client/request_list">Request</a> </li>
                  
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

<script>

$(document).ready(function(){
    $('.deletemake').click(function(){

        var makeid=$(this).data("id")
        
        $.ajax({
            url: "<?php echo url('/');?>/ajax/delete_dealer_make",
            data: {makeid:makeid,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              
              if(data=="Deleted"){
                 window.location.reload();
              }
            
            }
        });
        return false;
    });
    
  $('.add_style').click(function(){
    var requestid=$(this).data("id");
    var styleid=$(this).data("styleid");
    
    

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


      var sortby=$("#sortby").val();
      var pagestart=$("#pagestart").val();
      var pageend=$("#pageend").val();
      var requestid=$("#requestid").val();
      if(typeof sortby!= "undefined"){ 

        $.ajax({
                      url: "<?php echo url('/');?>/ajax/getupdatedbid",
                      data: {requestid:requestid,sortby:sortby,pagestart:pagestart,pageend:pageend,_token: '{!! csrf_token() !!}'},
                      type :"post",
                      success: function( data ) {
                        if(data){
                          $("#bidlist").html(data);
                        }
                        
                      
                      }
              });
      }
  $('#shortoptions').change(function(){
    var shortoptions=$("#shortoptions").val();
    //alert(shortoptions);
    $("#sortby").val(shortoptions);
    $("#pagestart").val(0);
    $("#pageend").val(10);
      var sortby=$("#sortby").val();
      var pagestart=$("#pagestart").val();
      var pageend=$("#pageend").val();
      var requestid=$("#requestid").val();
      if(typeof sortby!= "undefined"){ 

        $.ajax({
                      url: "<?php echo url('/');?>/ajax/getupdatedbid",
                      data: {requestid:requestid,sortby:sortby,pagestart:pagestart,pageend:pageend,_token: '{!! csrf_token() !!}'},
                      type :"post",
                      success: function( data ) {
                        if(data){
                          $("#bidlist").html(data);
                        }
                        
                      
                      }
              });
      }
  });

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
$('#year_search').change(function(){
  var year_search=$('#year_search').val();
  if(year_search!=""){
    $("#nextis").show();

  }

});

$('#plsnex').click(function(){

  
  $("#firsc").hide();
  $("#secsc").show();
  return false;
});
$('#sinses').click(function(){

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
            $.ajax({
                        url: "<?php echo url('/');?>/ajax/client-request",
                        data: {
                                make_search:make_search,
                                model_search:model_search,
                                condition_search:condition_search,
                                year_search:year_search,
                                tamo:tamo,
                                mtamo:mtamo,                               
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
            $.ajax({
                        url: "<?php echo url('/');?>/ajax/setto-signup",
                        data: {
                                make_search:make_search,
                                model_search:model_search,
                                condition_search:condition_search,
                                year_search:year_search,
                                tamo:tamo,
                                mtamo:mtamo,                               
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
                                _token: '{!! csrf_token() !!}'
                        },
                        type :"post",
                        success: function( data ) {
                          var urlnew="<?php echo url('/');?>/request_success";
                        $(location).attr('href',urlnew);
                        }
                        });
       return false;
});

});

</script>
</body>
</html>
