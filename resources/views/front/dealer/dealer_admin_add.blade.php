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
									    <label for="d_name_readonly">Dealership Name</label>
									    {{Form::text('d_name_readonly',$dealer_admin_details->dealership_name,['class' => 'form-control profile_control', 'required' => 'required', 'readonly' => 'true']) }}
								  	</div>
				              		<div class="form-group">
									    <label for="exampleInputEmail1">First Name</label>
									    {{ Form::text('fname','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								  	</div>
									<div class="form-group">
										<label for="exampleInputName1">Last Name</label>
										{{ Form::text('lname','',['class' => 'form-control profile_control', 'required' => 'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Email</label>
									    {{ Form::email('email','',['class' => 'form-control profile_control', 'required' => 'required']) }}
									</div>
									
									<div class="form-group">
									    <label for="exampleInputName1">Password</label>
									    {{ Form::password('password',['class' => 'form-control profile_control', 'required' => 'required', 'id' =>'password']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Confirm-Password</label>
									    {{ Form::password('conf_password',['class' => 'form-control profile_control', 'required' => 'required','id' =>'conf_password']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Address</label>
									    {{ Form::text('address','',['class' => 'form-control profile_control','required' => 'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">State</label>
									    {{ Form::select('state_id', $State,'',array('class' => 'form-control  profile_control','id'=>'state_id', 'required' => 'required')) }}
									</div>
									<div class="form-group"  id="city_div" style="display: none;">
									    
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Zip</label>
									   {{ Form::number('zip','',['class' => 'form-control profile_control', 'required' => 'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputName1">Phone</label>
									   {{ Form::number('phone','',['class' => 'form-control profile_control','required' => 'required']) }}
									</div>

									<div class="form-group">
									    <label for="total_amount">Total Amount Per Bid</label>
									    {{Form::text('total_amount','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								  	</div>
								  	<div class="form-group">
									    <label for="monthly_amount">Monthly Amount Per Bid</label>
									    {{Form::text('monthly_amount','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								  	</div>

									<div class="form-group">
									    <label for="exampleInputName1">Image</label>
									    {!! Form::file('images', array('class'=>'add-image')) !!}
									</div>
									
									
								        {{ Form::submit('ADD ADMIN',array('class' => 'btn btn-default btn-lg btn-block','id' => 'add_admin')) }}
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
				$('#add_admin').click(function(){
					//alert('hi')
					var password = $('#password').val();
					var conf_password = $('#conf_password').val();
					var length = $('#password').val().length;
					
					if (length > 5) 
					{
						if (password != conf_password) 
						{
							alert('Password and Confirm password should be same');
							return false;
						}
					}
					else
					{
						alert('Password length minimum 6 charecters')
						return false;
					}
				});
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