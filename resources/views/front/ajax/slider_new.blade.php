<?php
//echo "<pre>";
//print_r ($ImgPathArray);
//echo "</pre>";
//echo count($ImgPathArray);
if(isset($ImgPathArray)){

$loop = count($ImgPathArray);

$newImgPathArray = array_slice($ImgPathArray, 0, 8, true);

$img_loop = count($ImgPathArray);
}
?>

<!-- Carousel ============ -->
<?php if(!empty($newImgPathArray) && $NoImgPath!=0){ ?>
				<div id = "myCarousel" data-ride="carousel"class = "carousel slide">
				   
				   <!-- Carousel indicators -->
				    <ol class = "carousel-indicators">
				    @for ($i = 0; $i < 8; $i++)
					    <li data-target = "#myCarousel" data-slide-to = {{$i}} 
					    @if($i==0)
					    class = "active"
					    @endif
					    ></li>

					@endfor
					    
				    </ol>   
				   
				   <!-- Carousel items -->
				   <div class = "carousel-inner" role="listbox">
				  

				   	@while (list($key2, $value2) = each($newImgPathArray)) 

				   		
					    <div @if($key2==0)
					    class = "item active"
					    @else
					    class = "item"
					    @endif
					    >
					    
					    
					    <img src = "{{$value2['url']}}" alt = "First slide">
					   
				        
				        </div>
				        
				     @endwhile
					
				   </div>
				   
				   <!-- Carousel nav -->
				   <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
				   <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
				   
				</div> <!-- /.carousel -->
	<?php 
			}
	else { 

	?>

		<img src="{{ url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt="defaultimage" />
	<?php } ?>







       


