
<header id="header">
		<div class="top-bar">
		  <div class="container">
			<div class="row">
			  <div class="col-sm-6 col-xs-4">
				<!-- <form class="form-inline">
				  <div class="form-group">
				    <label class="sr-only" for="exampleInputEmail3">Member Login</label>
				    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Member Login">
				  </div>
				</form> -->
			  </div>
			  <div class="col-sm-6 col-xs-8">
				<div class="social">
				  <ul class="social-share">
				    <!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-phone-square"> </i></a><span style="color:#fff">+382.0800.222.333</span></li> -->
					@if($client!=0)
						<li>
							<a href="<?php echo url('/');?>/client-dashboard">
								<img src="<?php echo url('/');?>/public/front_end/images/pic1.png" class="img-circle" alt="" width="20" height="20">
							</a>
							<span style="color:#fff">{{Session::get('client_name')}}</span>
						</li>
					@else
						<li>
							<a href="<?php echo url('/');?>/dealer-signin">
								<i class="fa fa-user"> </i>
							
							<!-- <span style="color:#fff" -->Dealer's login<!-- </span> -->
							</a>
						</li>
					@endif
					
					
				  </ul>
				<!-- <div class="search">
					<form role="form">
					<input type="text" class="search-form" autocomplete="off" placeholder="Search">
					<i class="fa fa-search"></i>
					</form>
				</div> -->
				</div>
			  </div>
			</div>
		  </div> 
		</div> 
		<nav class="navbar navbar-inverse" role="banner">
		  <div class="container">
			<div class="navbar-header">
			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			 </button>
			 <a class="navbar-brand" href="{{ url('/') }}"><img src="<?php echo url('/');?>/public/front_end/images/logo.png" alt="logo"></a>
			</div>
			<div class="collapse navbar-collapse navbar-right">
			  <ul class="nav navbar-nav">
				<li 
					@if(isset($typex))
						@if($typex=="home")
							class="active"
						@endif
					@endif
				><a href="{{ url('/') }}">Home</a></li>
				<!-- <li><a href="">About Us</a></li> -->
				<li 
					@if(isset($typex))
						@if($typex=="services")
							class="active"
						@endif
					@endif
				><a href="{{url('/services')}}">Privacy Policy</a></li>
				<li 
					@if(isset($typex))
						@if($typex=="contact-us")
							class="active"
						@endif
					@endif
				><a href="{{url('/contact-us')}}">Contact-Us</a></li>
				@if($client!=0)
				<li><a href="{{url('/client_sign_out')}}">Logout</a></li>
				@endif
			  </ul>
			</div>
		  </div> 
		</nav> 

	</header> 
