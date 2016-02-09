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
        $('.checkpro').click(function(){

          if($(this).find('input[type=checkbox]').is(':checked'))
          {
            $(this).find('input[type=checkbox]').prop("checked", false);
            $(this).css("background-color","white");
          }
          else
          { 
            $(this).find('input[type=checkbox]').prop("checked", true);
            $(this).css("background-color","#f26722");
          }
        });
      });

			</script>