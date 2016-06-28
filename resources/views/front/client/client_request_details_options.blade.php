<!-- ================================================ -->
        <!-- OPTIONS TYPE FUEL GALLERY VIEW BEGIN  -->
        <!-- ================================================ -->
       <div id = "myCarousel" class = "carousel slide ctborder ctheight">
                   
                   <!-- Carousel indicators OptioinsWise-->
                    <ol class = "carousel-indicators">
                    @if($FuelMakeModelYearImageDetailsOptionsGalleryCount!=0)
                        @foreach($FuelMakeModelYearImageDetailsOptionsGallery as $vx=>$img)
                        <li data-target = "#myCarousel" data-slide-to = "{{$vx}}"  @if($vx==0)class = "active"@endif ></li>
                        @endforeach
                    @else
                        <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
                    @endif
                    </ol>   
                   
                   <!-- Carousel items -->
                   <div class = "carousel-inner client-carousel-img">
                   @if($FuelMakeModelYearImageDetailsOptionsGalleryCount!=0)
                        @foreach($FuelMakeModelYearImageDetailsOptionsGallery as $vx=>$img)
                            <div class = "item @if($vx==0) active @endif">
                                <img src = "{{ url('/')}}/public/fuelgallery/small/{{$img->fuelImg_small_jpgformatlocal}}" alt = "x">
                            </div>
                        @endforeach 
                    @else
                            <div class = "item active">
                                <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                            </div>
                    @endif 
                   </div>
                   
                   <!-- Carousel nav -->
                   <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
                   <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
                   
                </div> 
        <!-- ================================================ -->
        <!-- Options Images End -->
        <!-- ================================================ -->

