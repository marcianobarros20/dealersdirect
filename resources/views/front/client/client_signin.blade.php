@extends('front/layout/clientfrontend_signup_template')
@section('content')
<?php $login_usr_type=2;
			Session::put('login_type',$login_usr_type); ?>
		<section>
			<div class="container">
			@if(Session::get('error'))
				<div class = "alert alert-danger">
					<a href = "#" class = "close" data-dismiss = "alert">
					&times;
					</a>
					<strong>{{Session::get('error')}}</strong> 
				</div>
			@endif
				<h2 class="head center-block">SIGN IN AS A CLIENT</h2>
					<div class="">
							<div class="col-xs-12 sign_form">
								{{ Form::open(array('url' => 'client-signin','class'=>'form-horizontal')) }}
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
										<div class="col-sm-9">
										{{ Form::email('email','',['required'=>'required','class'=>'form-control']) }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
										<div class="col-sm-9">
										{{ Form::password('password',['required'=>'required','class'=>'form-control']) }}
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-9">
										{{ Form::submit('SIGN IN',array('class' => 'btn btn-default btn-lg btn-block sign_btn')) }}
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-9">
											<a class='btn btn-default btn-lg btn-block sign_btn' href="redirect">Sign In With Facebook <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i> </a>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-9">
											<a class='btn btn-default btn-lg btn-block sign_btn' href="{{ route('social.redirect', ['provider' => 'google']) }}"> Sign In With Google <i class="fa fa-google-plus-square fa-lg" aria-hidden="true"></i> </a>
										</div>
									</div>
								{!! Form::close() !!}
							
							</div>	<!-- /col-xs-12 col-sm-6 col-md-6 -->	
					</div>
			</div>
		</section>

@stop