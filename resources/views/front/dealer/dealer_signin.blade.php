@extends('front/layout/dealerfrontend_signup_template')
@section('content')
<section>
	<!-- @if(Session::get('error'))
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
	@endif -->

	@if(Session::get('error1'))
			<div class="container">
				<div class="col-xs-4"></div>
				<div class="alert alert-danger col-xs-4" align="center" style="text-align: center; font-weight: bold;"> {{ Session::get('error1') }}
					<a href="#" class="close" data-dismiss="alert">×</a>
				 </div>
				<div class="col-xs-4"></div>
			</div>
	@endif
	<div class="container">
		<h2 class="head center-block">SIGN IN AS A DEALER</h2>
		<div class="">
			<div class="col-xs-12 sign_form">
				{{ Form::open(array('url' => 'dealer-signin','class'=>'form-horizontal')) }}
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-9">
							{{ Form::email('email','',['class'=>'form-control', 'required' => 'required']) }}
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-9">
								{{ Form::password('password',['class'=>'form-control', 'required' => 'required']) }}
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