@extends('front/layout/frontend_inner_template')
@section('content')
<!-- ================================================== TESTIMONIALS ================================================== -->
    
	<section>
		<div class="container">
			<h2 class="head center-block">SIGN-UP AS A CLIENT</h2>
			<div class="">
			<div class="col-xs-12">
				@if(Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
  					</button>
  					<strong>Error</strong> <b>{!! Session::get('error') !!}</b>
				</div>
				@endif

			</div>
			<?php $login_usr_type=2;
			Session::put('login_type',$login_usr_type); ?>
				<div class="col-xs-12 sign_form">
					{{ Form::open(array('url' => 'clientregisterwithoutrequest','class'=>'form-horizontal')) }}
					
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-9">
								{{ Form::text('fname','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-9">
								{{ Form::text('lname','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-9">
								{{ Form::number('phone','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-9">
								{{ Form::email('email','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Zip</label>
							<div class="col-sm-9">
								{{ Form::number('zip','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-9">
								{{ Form::password('password',['required'=>'required','class'=>'form-control', 'id' => 'password']) }}
							</div>
						</div> 
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-9">
								{{ Form::password('conf_password',['required'=>'required','class'=>'form-control', 'id' =>
								'conf_password']) }}
							</div>
						</div>   
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-9">
								{{ Form::submit('SIGN-UP',array('class' => 'btn btn-default btn-lg btn-block sign_btn', 'id' => 'signup_client')) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-9">
								<a class='btn btn-default btn-lg btn-block sign_btn' href="redirect">Sign Up with Facebook <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
						<a class='btn btn-default btn-lg btn-block sign_btn' href="{{ route('social.redirect', ['provider' => 'google']) }}">Sign Up With Google <i class="fa fa-google-plus-square fa-lg" aria-hidden="true"> </i></a>
						</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-9">
								<a href="<?php echo url('/');?>" class="btn btn-default btn-lg btn-block sign_btn">SKIP <i class="fa fa-share"></i>
								</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>	
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
				$('#signup_client').click(function(){
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
			});
	</script>

    <!-- ================================================== END TESTIMONIALS ================================================== -->
@stop