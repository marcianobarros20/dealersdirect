@extends('front/layout/dealerfrontend_template')
@section('content')		
 <section>
	<div class="container pro-file-bla">
	  <h2 class="profile_head center-block">EDIT DETAILS</h2>
	    <div class="profile_details">
		    <div class="col-xs-12 profile_form">
		     	<div id="content">
			        <ul id="tabs" class="nav nav-tabs profile-browse" data-tabs="tabs">
				        <li class="active"><a href="#red" data-toggle="tab">Details</a></li>
				        <li><a href="#orange" data-toggle="tab">Change Password</a></li>
				        <li><a href="#bid_amount" data-toggle="tab">Bid Amount Information</a></li>
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="red">
				            <form action="{{ route('dealer.admins.update', ['update_id' =>$dealer_admin_details->id ]) }}" method="POST" enctype="multipart/form-data">
				            	<h3>Change Details</h3>
								<div class="form_back">
									<div class="form-group">
									    <label for="new_fname">Dealership Name:</label>
									    <input type="text" value="{{$dealer_admin_details->dealer_parent->dealership_name}}" name="new_fname" class="form-control profile_control" readonly="true">
								  	</div>
								  	<div class="form-group">
									    <label for="new_fname">Email/Username:</label>
									    <input type="text" value="{{$dealer_admin_details->email}}" name="new_fname" class="form-control profile_control" readonly="true">
								  	</div>
				              		<div class="form-group">
									    <label for="new_fname">Firstname:</label>
									    <input type="text" value="{{$dealer_admin_details->first_name}}" name="new_fname" class="form-control profile_control">
								  	</div>
									<div class="form-group">
										<label for="new_lname">Lastname:</label>
										<input type="text" value="{{$dealer_admin_details->last_name}}" name="new_lname" class="form-control profile_control">
									</div>
									<div class="form-group">
									    <label for="new_zip">Zip:</label>
									    <input type="text" value="{{$dealer_admin_details->dealer_details->zip}}" name="new_zip" class="form-control profile_control">
									</div>
									
									<div class="form-group">
									    <label for="new_phone">Phone Number:</label>
									    <input type="text" value="{{$dealer_admin_details->dealer_details->phone}}" name="new_phone" class="form-control profile_control">
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Address</label>
									    {{ Form::text('new_address',isset($dealer_admin_details->dealer_details->address)?$dealer_admin_details->dealer_details->address:null,['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">State</label>
									    {{ Form::select('state_id', $State,isset($dealer_admin_details->dealer_details->dealer_state->id)?$dealer_admin_details->dealer_details->dealer_state->id:null,array('class' => 'form-control','id'=>'state_id', 'required' => 'required')) }}
									</div>
									<div class="form-group" id="city_div" @if($cityarr!=1)style="display:none;"@endif>
										@if($cityarr==1)
										    <label for="exampleInputName1">City</label>
										    {{ Form::select('city_id', $City,isset($dealer_admin_details->dealer_details->dealer_city->id)?$dealer_admin_details->dealer_details->dealer_city->id:null,array('class' => 'form-control profile_control','id'=>'city_id', 'required' => 'required')) }}
									    @endif
									</div>
									<div class="form-group">
									    <label for="new_image">Upload New Image:</label>
									   <input type="file" name="new_image" class="form-control profile_control">
									</div>
									
								    <input type="hidden" name="old_image" value="{{$dealer_admin_details->dealer_details->image}}">  
								    <button type="submit" name="btn_submit" class ="btn btn-default btn-lg btn-block">Update</button>
		        					<input type="hidden" name="_token" value="{{ Session::token() }}">
								</div> <!-- /form_back -->
							{!! Form::close() !!}
				        </div>
				        <div class="tab-pane form-head" id="orange">
				            <!-- {{ Form::open(array('url' => 'dealereditpassword')) }}
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
								</div> 
							{!! Form::close() !!} -->
				        </div>
				        <div class="tab-pane form-head" id="bid_amount">
				        	<form action="{{ route('dealer.admins.updateBid', ['update_id' =>$dealer_admin_details->id ]) }}" method="POST" enctype="multipart/form-data">
				            	<h3>Change Bid Details</h3>
								<div class="form_back">
									
								  	<div class="form-group">
									    <label for="total_amount">Total Amount Per Bid</label>
									    {{Form::text('total_amount',isset($dealer_admin_bid_info->total_amount_per_bid)?$dealer_admin_bid_info->total_amount_per_bid:null,['class' => 'form-control profile_control', 'required' => 'required']) }}
								  	</div>
								  	<div class="form-group">
									    <label for="monthly_amount">Monthly Amount Per Bid</label>
									    {{Form::text('monthly_amount',isset($dealer_admin_bid_info->monthly_amount_per_bid)?$dealer_admin_bid_info->monthly_amount_per_bid:null,['class' => 'form-control profile_control', 'required' => 'required']) }}
								  	</div>
								  	{{ Form::submit('UPDATE',array('class' => 'btn btn-default btn-lg btn-block','id' => 'save_bid')) }}
								</div>
							</form>	
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