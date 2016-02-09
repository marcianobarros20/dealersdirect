@extends('front/layout/dealerfrontend_signup_template')
@section('content')
<section>
	<div class="container">
	<!-- <div class="alert alert-warning">
	Indication for<strong>ERROR</strong> in further procedure.
	</div> -->
		<section>
			<!-- @if(Session::get('error'))
				<?php $parrallal=Session::get('error');?>
				@foreach($parrallal->all() as $key=>$value)
					<div class="alert alert-danger"> {{$value}} </div>
					</br>
				@endforeach
			@endif
			@if(Session::get('error1'))
				<div class="alert alert-danger"> {{Session::get('error1')}} </div>
			@endif -->
			<div class="container deal-sign-up">
			<h2 class="profile_head center-block">Sign Up As A Dealer</h2>
				<div class="profile_details">
					<div class="col-xs-12 profile_form">
						{{ Form::open(array('url' => 'dealerregister')) }}
							<div class="form_back">
							<div class="form-group">
									<label for="exampleInputName1">Dealership Name</label>
										{{ Form::text('d_name','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputName1">First Name</label>
										{{ Form::text('fname','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputName1">Last Name</label>
										{{ Form::text('lname','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								
								<div class="form-group">
									<label for="exampleInputEmail1">Phone</label>
										{{ Form::number('phone','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Address</label>
										{{ Form::text('address','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group select-state">
									<label for="exampleInputEmail1">State</label>
										{{ Form::select('state_id', $State,'',array('data-placeholder' => 'Choose State...','id'=>'state_id', 'required' => 'required')) }}
								</div>
								<div class="form-group select-state" id="city_div" style="display: none;">
								</div>
								<div class="form-group">
									<label for="exampleInputName1">Zip</label>
										{{ Form::number('zip','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email/Username</label>
										{{ Form::email('email','',['class' => 'form-control profile_control', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputPassword3">Password</label>
										{{ Form::password('password',['class' => 'form-control profile_control', 'id' => 'password' ,'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputPassword3">Confirm Password</label>
										{{ Form::password('conf_password',['class' => 'form-control profile_control', 'id' => 'conf_password', 'required' => 'required']) }}
								</div>
								<div class="form-group">
									<label>Make</label>
									{{ Form::select('make[]', $Makes,'',array('data-placeholder' => 'Choose Make...','multiple' => 'multiple','id'=>'ms', 'required' => 'required')) }}
									
								</div>
							<button type="submit" class="btn btn-warning btn-lg btn-block" id="sign_up">SIGN UP</button>
							<!-- <p class="dealer_option">WANT A DEALER ACCOUNT? SIGN UP NOW!</p> -->
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#sign_up').click(function(){
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
                            url: "<?php echo url('/');?>/ajax/get_all_city",
                            data: {state_id:state_id,_token: '{!! csrf_token() !!}'},
                            type :"post",
                            success: function( data ) {
                                if (data){
                                    $("#city_div").html('');
                                    $("#city_div").html(data); 
                                    $("#city_div").show();
                                }
                            }
                  	});
				});
			});
		</script>
	</div>
</section>
@stop