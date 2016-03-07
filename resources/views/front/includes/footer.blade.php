




<!-- ================================================== BOTTOM FOOTER ================================================== -->
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