@extends('front/layout/dealerfrontend_template')
@section('content')

 <section>
	<div class="container pro-file-bla">
				@if(Session::get('message'))
				<div class = "alert alert-success">dealer_info
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
				        @if($Dealer->parent_id == 0 )
				        <li><a href="#more_details" data-toggle="tab">Office Details</a></li>
				        @endif
				        <li><a href="#orange" data-toggle="tab">Change Password</a></li>
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="red">
				            {{ Form::open(array('url' => 'dealereditdetails','id'=>'detedit','enctype'=>'multipart/form-data')) }}
				            	<h3>Change Details</h3>
								<div class="form_back">
								<div class="form-group">
								    <label for="d_name1">Dealership Name</label>
									@if($Dealer->parent_id == 0 )
									{{ Form::text('d_name1',$Dealer->dealership_name,['class' => 'form-control profile_control', 'required'=>'required']) }}

									@else
									{{ Form::text('d_name1',$Dealer->dealer_parent->dealership_name,['class' => 'form-control profile_control','readonly' => 'true']) }}

									@endif
								</div>
				              		<div class="form-group">
									    <label for="exampleInputEmail1">Email/Username</label>
									    {{ Form::email('email',$Dealer->email,['class' => 'form-control profile_control','readonly' => 'true']) }}
								  	</div>
									<div class="form-group">
										<label for="exampleInputName1">First Name</label>
										{{ Form::text('fname',$Dealer->first_name,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Last Name</label>
									    {{ Form::text('lname',$Dealer->last_name,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Phone</label>
									    {{ Form::text('phone',isset($Dealer->dealer_details->phone)?$Dealer->dealer_details->phone:null,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Address</label>
									    {{ Form::text('address',isset($Dealer->dealer_details->address)?$Dealer->dealer_details->address:null,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group" id="custom-select">
									    <label for="exampleInputName1">State</label>
									    {{ Form::select('state_id', $State,isset($Dealer->dealer_details->dealer_state->id)?$Dealer->dealer_details->dealer_state->id:null,array('class' => 'form-control','id'=>'state_id', 'required' => 'required')) }}
									</div>
									<div class="form-group" id="city_div" @if($cityarr!=1)style="display:none;"@endif>
										@if($cityarr==1)
										    <label for="exampleInputName1">City</label>
										    {{ Form::select('city_id', $City,isset($Dealer->dealer_details->dealer_city->id)?$Dealer->dealer_details->dealer_city->id:null,array('class' => 'form-control profile_control','id'=>'city_id', 'required' => 'required')) }}
									    @endif
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Zip</label>
										
									    {{ Form::number('zip',$Dealer->zip,['class' => 'form-control profile_control','required'=>'required']) }}
							
	
									</div>

									<div class="form-group">
									    <label for="new_image">Upload New Image:</label>
									   <input type="file" name="new_image" class="form-control profile_control">
									</div>
									
								      
								    {{ Form::hidden('old_image',isset($Dealer->dealer_details->image)?$Dealer->dealer_details->image:null,['class' => 'form-control profile_control']) }}
								        
								        {{ Form::submit('EDIT',array('class' => 'btn btn-default btn-lg btn-block')) }}
								</div> <!-- /form_back -->
							{!! Form::close() !!}
				        </div>
				        @if($Dealer->parent_id == 0 )
						<div class="tab-pane form-head" id="more_details">
						{{ Form::open(array('url' => 'dealeremoreditdetails','id'=>'more_details','enctype'=>'multipart/form-data')) }}
				            	<h3>Change Details</h3>
								<div class="form_back">
								<div class="form-group">
								    <label for="d_name1">Web URL</label>
								    {{ Form::text('web_url',isset($dealer_info->website_url)?$dealer_info->website_url:null,['class' => 'form-control profile_control']) }}
								</div>
				              		<div class="form-group">
									    <label for="exampleInputphone">Phone No.</label>
									    {{ Form::number('phone_no',isset($dealer_info->phone_no)?$dealer_info->phone_no:null,['class' => 'form-control profile_control']) }}
								  	</div>
									<div class="form-group">
										<label for="exampleInputemail">Email ID</label>
										{{ Form::email('email_id',isset($dealer_info->email_id)?$dealer_info->email_id:null,['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
										<label for="exampleInputcontact_address">Contact Address</label>
										{{ Form::textarea('contact_address',isset($dealer_info->contact_address)?$dealer_info->contact_address:null,['class' => 'form-control profile_control']) }}
									</div>
									<div class="form-group">
										<label for="exampleInputdetails">Details</label>
										{{ Form::textarea('details',isset($dealer_info->details)?$dealer_info->details:null,['class' => 'form-control profile_control']) }}
									</div>

									<div class="form-group">
									    <label for="new_logo">Upload Logo:</label>
									   
										{{ Form::file('dealer_logo', null,['class'=>'form-control profile_control']) }}

										{{ Form::hidden('old_image',isset($dealer_info->logo)?$dealer_info->logo:null,['class' => 'form-control profile_control']) }}
										
										{{ Form::hidden('info_id',isset($dealer_info->id)?$dealer_info->id:null,['class' => 'form-control profile_control']) }}
									</div>
									{{ Form::submit('ADD',array('class' => 'btn btn-default btn-lg btn-block')) }}
							
						</div>
						{!! Form::close() !!}
						</div>		
						@endif		        

				        <div class="tab-pane form-head" id="orange">
				            {{ Form::open(array('url' => 'dealereditpassword')) }}
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
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#state_id').change(function(){
					var state_id = $('#state_id').val();
					
					$.ajax({
                            url: "<?php echo url('/');?>/ajax/get_all_edit_city",
                            data: {state_id:state_id,_token: '{!! csrf_token() !!}'},
                            type :"post",
                            success: function( data ) {
                                if (data){
                                    $("#city_div").html('');
                                    $("#city_div").html(data);
                                    $("#city_id").selectric();  
                                    $("#city_div").show();

                                }
                            }
                  	});
				});
			});
		</script>

@stop