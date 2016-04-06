<!DOCTYPE html>
	<html lang="en">
		@include('front.section_includes.clienthead')
		<body class="homepage">
			@include('front.section_includes.clientheader')

			@include('front.section_includes.clientsearch')


			@yield('content')

			<!-- ---------------footer section ------------------>
			@include('front.section_includes.clientfooter') 
			<!-- <script src="js/jquery.js"></script> -->
			@include('front.section_includes.clientfoot')
		</body>
</html>



