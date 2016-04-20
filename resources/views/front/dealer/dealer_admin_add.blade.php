@extends('front/layout/dealerfrontend_template')
@section('content')



<section>

	@if(Session::get('error'))
		<?php $parrallal=Session::get('error');?>
		@foreach($parrallal->all() as $key=>$value)
			<div class="container">
				<div class="col-xs-4"></div>
				<div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{$value}} 
					<a href="#" class="close" data-dismiss="alert">×</a>
				</div>
				<div class="col-xs-4"></div>
			</div>
		@endforeach
	@endif
<!-- 
	@if(Session::get('error1'))
			<div class="container">
				<div class="col-xs-4"></div>
				<div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('error1') }}
					<a href="#" class="close" data-dismiss="alert">×</a>
				 </div>
				<div class="col-xs-4"></div>
			</div>
	@endif -->
	<div class="container add-deal-admin">
				@if(Session::get('message'))
				<div class = "alert alert-success">
					<a href = "#" class = "close" data-dismiss = "alert">
					&times;
					</a>
					<strong>{{Session::get('message')}}</strong> 
				</div>
				@endif
	  <h2 class="profile_head center-block">Add</b> Admin</h2>
	    <div class="profile_details">
		    <div class="col-xs-12 profile_form">
		     	<div id="content">
			        <ul id="tabs" class="nav nav-tabs profile-browse" data-tabs="tabs">
				        <li class="active"><a href="#red" data-toggle="tab">Details</a></li>
				        
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="red">
				            {{ Form::open(array('url' => 'dealers/dealer_add_admin', 'files'=>true)) }}
				            	<h3>Details</h3>
								<div class="form_back">
				              		<div class="form-group">
									    <label for="exampleInputEmail1">First Name</label>
									    {{ Form::text('fname','',['class' => 'form-control profile_control']) }}
								  	</div>
									<div class="form-group">
										<label for="exampleInputName1">Last Name</label>
										{{ Form::text('lname','',['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Email</label>
									    {{ Form::text('email','',['class' => 'form-control profile_control']) }}
									</div>
									
									<div class="form-group">
									    <label for="exampleInputName1">Password</label>
									    {{ Form::password('password',['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Confirm-Password</label>
									    {{ Form::password('conf_password',['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Zip</label>
									   {{ Form::text('zip','',['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Phone</label>
									   {{ Form::text('phone','',['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Image</label>
									    {!! Form::file('images', array('class'=>'add-image')) !!}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Address</label>
									    {{ Form::textarea('address','',['class' => 'form-control profile_control']) }}
									</div>
									
								        {{ Form::submit('ADD ADMIN',array('class' => 'btn btn-default btn-lg btn-block')) }}
								</div> <!-- /form_back -->
							{!! Form::close() !!}
				        </div>
				        
			        </div>
		        </div>
		    </div>
		</div>
	</div>
</section>


@stop