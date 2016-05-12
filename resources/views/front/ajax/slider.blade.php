

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


