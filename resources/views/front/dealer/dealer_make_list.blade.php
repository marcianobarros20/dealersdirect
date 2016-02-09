@extends('front/layout/dealerfrontend_template')
@section('content')
		
    <!-- ================================================== Home Listing ================================================== -->

    <section class="selection_area">
     <div class="container">
       <div class="col-xs-12 next_button_area">
        <a href="<?php echo url('/');?>/dealers/dealer_add_make" type="button" class="btn btn-warning next_btn pull-right"> Make List</a>
       </div>
     </div><!--  /container -->
    </section>


    <section class="brand_section">
      <div class="container deal-make-lis">
        <div class="">
            
        @foreach ($DealerMakeMap as $DealerMake)
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="brand_request make-pic">
                 @if($DealerMake->makes->image!="")
                 <div class="img-make">
                  <img src="{{ url('/')}}/public/uploads/carmake/thumb/{{$DealerMake->makes->image}}" title="car" alt="car" />
                 </div>
                @else
                <div class="img-make">
                  <img src="<?php echo url('/');?>/public/front_end/images/dealers_direct_pic_logo.png" title="car" alt="car" />
                </div>
                @endif
                    
                    <h2><?php echo $DealerMake->makes->name;?></h2>
                      <div class="btn-group deletemake"  data-id="<?php echo $DealerMake->makes->id;?>">
                       <button id="" type="button" class="btn btn-success">Delete</button>
                       <button type="button" class="btn btn-warning">
                        <i class="fa fa-long-arrow-right"></i>
                       </button>
                      </div>
                </div>
            </div>    <!-- /col-xs-12 col-md-4-->

            
        @endforeach
        
          
          
          
          
        </div>
      </div>
    </section>

    <!-- ================================================== END Home Listing ============================================== -->


@stop