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
		@include('front.section_includes.dealerhead')
		<body class="homepage">
			@include('front.section_includes.dealerheader')

			
			@yield('content')

			<!-- ---------------footer section ------------------>
			@include('front.section_includes.dealerfooter') 
			<!-- <script src="js/jquery.js"></script> -->
			@include('front.section_includes.dealerfoot')
<!-- <div  id="Date"></div>
<div  id="hours"></div>
<div id="min"></div>
<div  id="sec"></div>
<script type="text/javascript">
$(document).ready(function() {
// Making 2 variable month and day
var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

// make single object
var newDate = new Date();
// make current time
newDate.setDate(newDate.getDate());
// setting date and time
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
// Create a newDate() object and extract the seconds of the current time on the visitor's
var seconds = new Date().getSeconds();
// Add a leading zero to seconds value
$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
},1000);

setInterval( function() {
// Create a newDate() object and extract the minutes of the current time on the visitor's
var minutes = new Date().getMinutes();
// Add a leading zero to the minutes value
$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
},1000);

setInterval( function() {
// Create a newDate() object and extract the hours of the current time on the visitor's
var hours = new Date().getHours();
// Add a leading zero to the hours value
$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
}, 1000); 
});

</script> -->
<script type="text/javascript">
$(document).ready(function(){

	$('.remindbox').click(function(){
		var inox=$(this).data('inox');
		console.log(inox);
		$.ajax({
					url: "<?php echo url('/');?>/ajax/setleadreminder",
					data: {lead_id:inox,_token: '{!! csrf_token() !!}'},
					type :"post",
					success: function( data ) {
						
							$(".modal-body").html('');
							$(".modal-body").html(data)
						
					}
				});
	});
	setInterval(function() { FetchData(); },10000);
	function FetchData(){
		console.log("hi");
		//return true;
		var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
		
		var newDate = new Date();
		newDate.setDate(newDate.getDate());
		var max=newDate.getMonth()+1
		console.log(newDate.getFullYear()+"/"+max+"/"+newDate.getDate());
		console.log(newDate.getHours()+"/"+newDate.getMinutes()+"/"+newDate.getSeconds());
		
		}
});
</script>

		</body>
</html>
