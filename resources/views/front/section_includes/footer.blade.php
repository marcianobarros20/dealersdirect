
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
					<!-- <li 
						@if(isset($typex))
							@if($typex=="start-a-report")
								class="active"
							@endif
						@endif
					><a href="<?php //echo url('/');?>/start-a-report">Report Bug</a></li> -->
				</ul>
			</div>
			<p class="pull-right dealers-right">&copy; 2016- <a target="_blank" href="https://www.tier5.us/">DealersDirect</a>. All Rights</p>
		</div>
	</div>
</footer>


<!-- ************************Floating Report Bug Div Start *********** -->
<style type="text/css">
    body .divMain{
        height:100%!important;
  
        overflow:auto;
    }
   .divMain #floatDiv {
        position:absolute;
        background:rgba(0,0,0,0.7);
        right: 0;
        top: 200px;
       width:100px;
        height:50px;
        color:#fff;
        z-index:99999;
        padding: 10px;
        font-weight: bold;
        cursor: pointer;
        border:1px solid #eee;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .divMain #floatDiv:hover{
    background:rgba(242,103,34,0.7);
    }
    #floatDiv a{color: #fff; text-decoration: none;}
    #floatDiv a:hover{color:#000;}
</style>
		<div class="divMain">
        <div id="floatDiv"><a href="<?php echo url('/');?>/start-a-report">Report Bug</a>
        </div>
    	</div>

    <script language="javascript">
            $(document).ready(function(){
          //on window scroll fire it will call a function.
                $(window).scroll(function () {
         //after window scroll fire it will add define pixel added to that element.
                    set = $(document).scrollTop()+150+"px";
         //this is the jQuery animate function to fixed the div position after scrolling.
                    $('#floatDiv').animate({top:set},{duration:1000,queue:false});

                });

            });
         </script>

<!-- ************************Floating Report Bug Div End *********** -->