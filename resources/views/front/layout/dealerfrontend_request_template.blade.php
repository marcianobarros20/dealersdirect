<!DOCTYPE html>
	<html lang="en">
		@include('front.section_includes.dealerheadrequest')
		<body class="homepage">
			@include('front.section_includes.dealerheader')

			
			@yield('content')

			<!-- ---------------footer section ------------------>
			@include('front.section_includes.dealerfooter') 
			<!-- <script src="js/jquery.js"></script> -->
			@include('front.section_includes.dealerfootrequest')
		</body>
</html>