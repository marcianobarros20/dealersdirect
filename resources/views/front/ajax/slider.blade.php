<link href="<?php echo url('/');?>/public/front_end/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="<?php echo url('/');?>/public/front_end/css/finalstyle.css" rel="stylesheet">
<link href="<?php echo url('/');?>/public/front_end/css/responsive.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="<?php echo url('/');?>/public/front_end/selectrick/style.css">
<link rel="stylesheet" href="<?php echo url('/');?>/public/front_end/selectrick/selectric.css">
<link rel="stylesheet" href="<?php echo url('/');?>/public/front_end/selectrick/customoptions.css">
<link rel="stylesheet" href="<?php echo url('/');?>/public/front_end/selectrick/lib/prism.css">

<!-- Carousel ============ -->
				<div id = "myCarousel" class = "carousel slide">
				   
				   <!-- Carousel indicators -->
				    <ol class = "carousel-indicators carousel-indicatoredit">
				    @foreach($EdmundsMakeModelYearImage as $key=>$Img)
					    <li data-target = "#myCarousel" data-slide-to = {{$key}} 
					    @if($key==0)
					    class = "active"
					    @endif
					    ></li>
					@endforeach
					    
				    </ol>   
				   
				   <!-- Carousel items -->
				   <div class = "carousel-inner">
				   	@foreach($EdmundsMakeModelYearImage as $key=>$Img)
					    <div @if($key==0)
					    class = "item active"
					    @else
					    class = "item"
					    @endif
					    >
					        <img src = "{{ url('/')}}/public/edmunds/make/small/{{$Img->local_path_smalll}}" alt = "First slide">
				        </div>
					@endforeach
				   </div>
				   
				   <!-- Carousel nav -->
				   <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
				   <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
				   
				</div> <!-- /.carousel -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/bootstrap.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/wow.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/js/main.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/lib/jquery.min.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/lib/prism.js"></script>
<script src="<?php echo url('/');?>/public/front_end/selectrick/jquery.selectric.js"></script>
