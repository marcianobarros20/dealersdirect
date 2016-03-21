




<!-- ================================================== BOTTOM FOOTER ================================================== -->
<footer>
      <div class="bottom-footer clearfix;">
    <div class="container">
          <div class="row">
        <div class="six columns">
              <div class="copyrights">
            <p>&copy; 2016 - DEALERSDIRECT</p>
          </div>
            </div>
        <div class="six columns">
              <div class="footer-navigation">
                <ul class="clearfix">
                  <li><a href="<?php echo url('/');?>/dealer-dashboard" class="active">Dashboard</a> </li>
                  <li><a href="<?php echo url('/');?>/dealer/profile">Profile</a> </li>
                  <li><a href="<?php echo url('/');?>/dealer/dealer_make">Makes</a> </li>
                  
                </ul>
                <p><a href="http://www.edmunds.com/?id=meth499r2aepx8h7c7hcm9qz"><img src="<?php echo url('/');?>/public/front/images/300_horizontal_grey.png"></a></p>
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
    $('.addimagecontain').click(function(){

        $.ajax({
            url: "<?php echo url('/');?>/ajax/add-image-option",
            data: {_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              
              $('.imagecontainer').append(data);
              
            
            }
        });

      return false;
    });
    $('.deleteprevious').click(function(){
      var modid=$(this).data("id");
      console.log(modid);
      $( "div" ).remove( "#"+modid );
      return false;

    })
    $('.dealpostbid').click(function(){
      var modid=$(this).data("id");
      console.log(modid);

      $.ajax({
            url: "<?php echo url('/');?>/ajax/checkdealersstatus",
            data: {modid:modid,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
             if(data==0){
                        var urlnew="<?php echo url('/');?>/dealers/blocked";
                        $(location).attr('href',urlnew);
             }
             if(data==1){
                        var urlnewb="<?php echo url('/');?>/dealers/post-bid/"+modid;
                        $(location).attr('href',urlnewb);
             }
            }
        });
      return false;
    });
    $('.dealeditbid').click(function(){
      var modid=$(this).data("id");
      console.log(modid);
      $.ajax({
            url: "<?php echo url('/');?>/ajax/checkdealersstatus",
            data: {modid:modid,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if(data==0){
                        var urlnew="<?php echo url('/');?>/dealers/blocked";
                        $(location).attr('href',urlnew);
             }
             if(data==1){
                        var urlnewb="<?php echo url('/');?>/dealers/edit-bid/"+modid;
                        $(location).attr('href',urlnewb);
             }
            }
        });
      return false;
    });
    $('.dealstopbid').click(function(){
      var modid=$(this).data("id");
      console.log(modid);
      $.ajax({
            url: "<?php echo url('/');?>/ajax/checkdealersstatus",
            data: {modid:modid,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
              if(data==0){
                        var urlnew="<?php echo url('/');?>/dealers/blocked";
                        $(location).attr('href',urlnew);
             }
             if(data==1){
                        var urlnewb="<?php echo url('/');?>/dealers/stop-bid/"+modid;
                        $(location).attr('href',urlnewb);
             }
            }
        });
      return false;
    });

});

</script>
</body>
</html>
