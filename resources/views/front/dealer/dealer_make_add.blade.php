@extends('front/layout/dealerfrontend_template')
@section('content')
	

	<section class="brand_section">
		  <div class="container add-make-con">
		  	{{ Form::open(array('url' => 'dealeraddmake')) }}
		    <div class="">
		    	@foreach ($Make as $key=>$value)
				<div class="col-xs-12 col-sm-4 col-md-4">
					
					<div class="brand_request checkpro">
							{{ Form::checkbox('agree[]', $value->id, null, array('id'=>$value->id,'style'=>"display:none;")) }}
							@if($value->image!="")
							<img src="{{ url('/')}}/public/uploads/carmake/thumb/{{$value->image}}" title="car" class="img-responsive" alt="car" />
							@else
							<img src="<?php echo url('/');?>/public/front_end/images/dealers_direct_pic_logo.png" class="img-responsive" title="car" alt="car" />
							@endif
							<div class="checkbox select_brand">
								<label>
									<?php echo $value->name; ?>
								</label>
							</div>
					</div>
				</div>
				@endforeach
				
				{{ Form::submit('ADD',array('class' => 'btn btn-warning btn-lg btn-block')) }}
	        </div>
	       	{{ Form::close() }}
		  </div>
	</section>	
@stop