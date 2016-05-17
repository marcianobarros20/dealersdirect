<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js st-ie6" lang=""> <![endif]-->
<!--[if IE 7]> <html class="no-js st-ie7" lang=""> <![endif]-->
<!--[if IE 8]> <html class="no-js st-ie8" lang=""> <![endif]-->
<!--[if IE 9]> <html class="no-js st-ie9" lang=""> <![endif]-->
<!--[if gt IE 9]> <html class="no-js lang=""> <![endif]-->
<!--[if lt IE 9]>
 <script src="/js/html5shiv.js" type="text/javascript"></script>
 <script src="/js/respond.min.js" type="text/javascript"></script>
<![endif]-->
	<html lang="en">
		@include('front.section_includes.dealerheadrequest')
		<body class="homepage">
			@include('front.section_includes.dealerheader')

			
			@yield('content')

			<!-- ---------------footer section ------------------>
			@include('front.section_includes.dealerfooter') 
			<!-- <script src="js/jquery.js"></script> -->
			@include('front.section_includes.dealerfootrequest')
			<script type="text/javascript">
$(document).ready(function(){
FetchData();
	$('.remindbox').click(function(){
		var inox=$(this).data('inox');
		console.log(inox);
		$.ajax({
					url: "<?php echo url('/');?>/ajax/setleadreminder",
					data: {lead_id:inox,_token: '{!! csrf_token() !!}'},
					type :"post",
					success: function( data ) {
						
							$(".modal-body").html('');
							$(".modal-body").html(data);
						
					}
				});
	});
	setInterval(function() { FetchData(); },10000);
	function FetchData(){
		
		var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
		var newDate = new Date();
		newDate.setDate(newDate.getDate());
		var max=newDate.getMonth()+1
		var timeconst=( newDate.getHours() < 10 ? "0" : "" ) +newDate.getHours()+":"+( newDate.getMinutes() < 10 ? "0" : "" ) +newDate.getMinutes()+":"+( newDate.getSeconds() < 10 ? "0" : "" ) +newDate.getSeconds();
		var dateconst=newDate.getFullYear()+"-"+( max < 10 ? "0" : "" ) +max+"-"+( newDate.getDate() < 10 ? "0" : "" ) +newDate.getDate();

		$.ajax({
			url: "<?php echo url('/');?>/ajax/getleadreminder",
			data: {dateconst:dateconst,timeconst:timeconst,_token: '{!! csrf_token() !!}'},
			type :"post",
			success: function( data ) {
				
					$("#remindernot").html(data);
				
			}
		});
	}

	$('#rembox').click(function(){
		$(".notification-box").html('');
		$(".notification-box").html('<a class="viewall" href="#">Loading.....</a>');
		$(".notification-box").toggle();
		var newDate = new Date();
		newDate.setDate(newDate.getDate());
		var max=newDate.getMonth()+1;
		var timeconst=( newDate.getHours() < 10 ? "0" : "" ) +newDate.getHours()+":"+( newDate.getMinutes() < 10 ? "0" : "" ) +newDate.getMinutes()+":"+( newDate.getSeconds() < 10 ? "0" : "" ) +newDate.getSeconds();
		var dateconst=newDate.getFullYear()+"-"+( max < 10 ? "0" : "" ) +max+"-"+( newDate.getDate() < 10 ? "0" : "" ) +newDate.getDate();
		$.ajax({
			url: "<?php echo url('/');?>/ajax/getunreadleadreminder",
			data: {dateconst:dateconst,timeconst:timeconst,_token: '{!! csrf_token() !!}'},
			type :"post",
			success: function( data ) {
				$(".notification-box").html('');
				$(".notification-box").html(data);
					//$("#remindernot").html(data);
				
			}
		});
		return false;
	});
});
</script>
		</body>
</html>