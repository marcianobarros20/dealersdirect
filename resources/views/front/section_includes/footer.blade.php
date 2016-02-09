
<footer id="home_footer" class="midnight-blue  navbar-fixed-bottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a href="#"><img src="<?php echo url('/');?>/public/front_end/images/edmundslogo.png" alt="image"></a>
			</div>
			<div class="col-sm-6">
				<ul class="pull-right">
					<li
						@if(isset($typex))
							@if($typex=="home")
								class="active"
							@endif
						@endif
					><a href="<?php echo url('/');?>">Home</a></li>
					<!-- <li ><a href="">About Us</a></li> -->
					<li 
						@if(isset($typex))
							@if($typex=="services")
								class="active"
							@endif
						@endif
					><a href="<?php echo url('/');?>/services">Privacy Policy</a></li>
					<li 
						@if(isset($typex))
							@if($typex=="contact-us")
								class="active"
							@endif
						@endif
					><a href="<?php echo url('/');?>/contact-us">Contact-Us</a></li>
				</ul>
			</div>
			<p class="pull-right dealers-right">&copy; 2016- <a target="_blank" href="https://www.tier5.us/">DealersDirect</a>. All Rights</p>
		</div>
	</div>
</footer> 