




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

});

</script>
</body>
</html>
