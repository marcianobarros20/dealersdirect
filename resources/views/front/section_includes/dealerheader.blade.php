<header id="header">
				<div class="top-bar">
					<div class="container">
						<div class="row">
							<div class="col-sm-4 col-xs-4">

							</div>
							<div class="col-sm-8 col-xs-8">
								<div class="social">
									<ul class="social-share">
										<li class="note-bell">
											<a href="" id="rembox">
												<i class="fa fa fa-bell"></i> <span id="remindernot"> </span>
											</a>
										</li>
										<!-- <li>
											<a href="#">
												<i class="fa fa-facebook"></i>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-twitter"></i>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-phone-square"> </i>
											</a>
											<span style="color:#fff">+382.0800.222.333</span>
										</li> -->
										
										<li>
											<a href="#">
												<img src="<?php echo url('/');?>/public/front_end/images/pic1.png" class="img-circle" alt="" width="20" height="20">
											</a>
											<span style="color:#fff">{{Session::get('dealer_name')}}</span>
										</li>
										<!--Notification box start-->
										<div class="notification-box" style="display:none;">
											

										</div>
										<!--Notification box end-->
										
									</ul>

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
							<a class="navbar-brand" href="<?php echo url('/');?>">
								<img src="<?php echo url('/');?>/public/front_end/images/logo.png" alt="logo">
							</a>
						</div>
						<div class="collapse navbar-collapse navbar-right">
							<ul class="nav navbar-nav">
								
								<li><a href="<?php echo url('/');?>/dealer-dashboard">Dashboard</a></li>
								<li><a href="<?php echo url('/');?>/dealer/profile">Profile</a></li>
								@if(Session::get('dealer_parent')==0)
                					<li><a href="<?php echo url('/');?>/dealer/admins">Admins</a>

                					</li>
                				
								<li><a href="<?php echo url('/');?>/dealer/dealer_make">Makes</a>
                				</li>
                				@endif 
                                <li><a href="<?php echo url('/');?>/dealers/request_list">Requests</a>

                                </li>
                                <li><a href="<?php echo url('/');?>/dealers/bid_list">Bids</a>

                                </li>
                                <li><a href="<?php echo url('/');?>/dealers/contact_list">Contacts</a>
                                
                                </li>
                                <li><a href="<?php echo url('/');?>/dealers/lead_list">Leads</a>
                                
                                </li>
                                <li><a href="<?php echo url('/');?>/dealers/analytics">Analytics</a>
                                </li>
                                <li><a href="<?php echo url('/');?>/dealer_sign_out">Log-out</a>

                </li>
							</ul>
						</div>
					</div> 
				</nav> 
			</header> 