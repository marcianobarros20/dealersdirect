@extends('front/layout/clientfrontend_template')
@section('content')
		
 
<section>
	<div class="container pro-container">
	@if(Session::get('message'))
				<div class = "alert alert-success">
					<a href = "#" class = "close" data-dismiss = "alert">
					&times;
					</a>
					<strong>{{Session::get('message')}}</strong> 
				</div>
	@endif
	  <h2 class="profile_head center-block">PROFILE & DETAILS</h2>
	    <div class="profile_details">
		    <div class="col-xs-12 profile_form">
		     	<div id="content">
			        <ul id="tabs" class="nav nav-tabs profile-browse" data-tabs="tabs">
				        <li class="active"><a href="#red" data-toggle="tab">Details</a></li>
				        <li><a href="#orange" data-toggle="tab">Change Password</a></li>
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="red">
				            {{ Form::open(array('url' => 'clienteditdetails','id'=>'cliedit')) }}
				            	<h3>Change Details</h3>
								<div class="form_back">
				              		<div class="form-group">
									    <label for="exampleInputEmail1">Email/Username</label>
									    
									    {{ Form::text('email',$Client->email,['class' => 'form-control profile_control','readonly' => 'true']) }}
								  	</div>
									<div class="form-group">
										<label for="exampleInputName1">First Name</label>
										{{ Form::text('fname',$Client->first_name,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Last Name</label>
									    {{ Form::text('lname',$Client->last_name,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Phone</label>
									    {{ Form::text('phone',$Client->phone,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Zip</label>
									    {{ Form::text('zip',$Client->zip,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									
											{{ Form::submit('EDIT',array('class' => 'btn btn-default btn-lg btn-block')) }}
								        
								</div> <!-- /form_back -->
							{!! Form::close() !!}
				        </div>
				        <div class="tab-pane form-head" id="orange">
				            {{ Form::open(array('url' => 'clienteditpassword')) }}
				            	<h3>Change Password</h3>
								<div class="form_back">
				              		<div class="form-group">
									    <label for="exampleInputPassword1">Password</label>
									    
									    {{ Form::password('password',['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputPassword1">Confirm Password</label>
									    
									    {{ Form::password('conf_password',['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
								       
								        {{ Form::submit('EDIT',array('class' => 'btn btn-default btn-lg btn-block')) }}
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