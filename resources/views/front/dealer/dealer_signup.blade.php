@extends('front/layout/dealerfrontend_signup_template')
@section('content')
<section>
	<div class="container">
	<!-- <div class="alert alert-warning">
	Indication for<strong>ERROR</strong> in further procedure.
	</div> -->
		<section>
			<div class="container deal-sign-up">
			<h2 class="profile_head center-block">Sign Up As A Dealer</h2>
				<div class="profile_details">
					<div class="col-xs-12 profile_form">
						{{ Form::open(array('url' => 'dealerregister')) }}
							<div class="form_back">
								<div class="form-group">
									<label for="exampleInputName1">First Name</label>
										{{ Form::text('fname','',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputName1">Last Name</label>
										{{ Form::text('lname','',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email/Username</label>
										{{ Form::text('email','',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputName1">Zip</label>
										{{ Form::text('zip','',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputPassword3">Password</label>
										{{ Form::password('password',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label for="exampleInputPassword3">Confirm Password</label>
										{{ Form::password('conf_password',['class' => 'form-control profile_control','required'=>'required']) }}
								</div>
								<div class="form-group">
									<label>Make</label>
									{{ Form::select('make[]', $Makes,'',array('data-placeholder' => 'Choose Make...','multiple' => 'multiple','required'=>'required','id'=>'ms')) }}
									
								</div>
							<button type="submit" class="btn btn-warning btn-lg btn-block">SIGN UP</button>
							<!-- <p class="dealer_option">WANT A DEALER ACCOUNT? SIGN UP NOW!</p> -->
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</section>
	</div>
</section>
@stop