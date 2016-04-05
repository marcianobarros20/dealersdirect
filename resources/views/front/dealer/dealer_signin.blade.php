@extends('front/layout/dealerfrontend_signup_template')
@section('content')
<section>
	<div class="container">
		<h2 class="head center-block">SIGN IN AS A DEALER</h2>
		<div class="row">
			<div class="col-xs-12 sign_form">
				{{ Form::open(array('url' => 'dealer-signin','class'=>'form-horizontal')) }}
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-9">
							{{ Form::text('email','',['required'=>'required','class'=>'form-control']) }}
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
				{!! Form::close() !!}
				<p class="dealer_option">WANT A DEALER ACCOUNT? <a href="<?php echo url('/');?>/dealer-signup">SIGN UP NOW!</a></p>
			</div>	<!-- /col-xs-12 col-sm-6 col-md-6 -->	
		</div>
	</div>
</section>

@stop