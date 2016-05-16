<link rel="stylesheet" type="text/css" href="<?php echo url('/');?>/public/front_end/datetimesource/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<div class="form-group">
			<label  >Remider Time</label>
			<input type="text" value=""  class="form-control profile_control" id="datetimepicker_mask"/>
            <label >Remider Note</label>
            <textarea type="name" class="form-control profile_control" rows="5" id="detresx" placeholder=""></textarea>
            <div class="btns">
                <button type="button" data-request="{!! $inox !!}" class="btn btn-default c-p reminderset"><i class="fa fa-check"></i> Set Reminder</button>
                
            </div>
        </div>
<script src="<?php echo url('/');?>/public/front_end/datetimesource/jquery.js"></script>
<script src="<?php echo url('/');?>/public/front_end/datetimesource/build/jquery.datetimepicker.full.js"></script>
<script>


$.datetimepicker.setLocale('en');

var newDate = new Date();

newDate.setDate(newDate.getDate());
var max=newDate.getMonth()+1
var dasx=newDate.getFullYear()+"/"+max+"/"+newDate.getDate();
//console.log(dasx);

$('#datetimepicker_mask').datetimepicker({
	mask:'2016/19/39 29:59',
	startDate:	dasx,
	minDate:dasx,
	format:'Y/m/d H:i:s',
});

$(document).ready(function(){

	$('.reminderset').click(function(){
		var inox=$(this).data('request');
		var datatime=$("#datetimepicker_mask").val();
		var details=$("#detresx").val();
		$.ajax({
					url: "<?php echo url('/');?>/ajax/setleadremindersubmit",
					data: {lead_id:inox,datatime:datatime,details:details,_token: '{!! csrf_token() !!}'},
					type :"post",
					success: function( data ) {
						
							if(data==3){
							var urlnew="<?php echo url('/');?>/dealers/lead_list";
                          	$(location).attr('href',urlnew);
							}
							
						
					}
				});
	});
});


</script>