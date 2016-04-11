
<footer id="home_footer" class="midnight-blue">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a href="#"><img src="<?php echo url('/');?>/public/front_end/images/edmundslogo.png" alt="image"></a><br>
				&copy; 2016- <a target="_blank" href="https://www.tier5.us/">DealersDirect</a>. All Rights Reserved.
			</div>
			<div class="col-sm-6">
				<ul class="pull-right">
					<li @if($typex=="home")class="active"@endif><a href="<?php echo url('/');?>">Home</a></li>
					<li ><a href="<?php echo url('/');?>">About Us</a></li>
					<li @if($typex=="services")
				class="active"
				@endif><a href="<?php echo url('/');?>/services">Services</a></li>
					<li @if($typex=="contact-us")
				class="active"
				@endif><a href="<?php echo url('/');?>/contact-us">Contact-Us</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer> 