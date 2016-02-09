@extends('front/layout/frontend_inner_template')
@section('content')
<!-- ================================================== TESTIMONIALS ================================================== -->
    
	<section>
		<div class="container">
			<div class="intro_text">
				<h2>SUCESS</h2>
				<p>Thanks {{ $RequestQueue->fname }} {{ $RequestQueue->lname }}</p>
                <p>Your Request have been sent to the irrespective Dealers, you will be contacted as soon as possible for better options please SIGN-UP with us Or SKIP the Form Below</p>
			</div>
			<h2 class="head center-block">SIGN-UP AS A CLIENT</h2>
			<div class="">
				<div class="col-xs-12 sign_form">
					{{ Form::open(array('url' => 'clientregister','class'=>'form-horizontal')) }}
					{{ Form::hidden('id',$RequestQueue->id,'') }}
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-9">
								{{ Form::text('fname',$RequestQueue->fname,['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-9">
								{{ Form::text('lname',$RequestQueue->lname,['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-9">
								{{ Form::number('phone',$RequestQueue->phone,['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-9">
								{{ Form::email('email',$RequestQueue->email,['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Zip</label>
							<div class="col-sm-9">
								{{ Form::number('zip',$RequestQueue->zip,['placeholder' => '','required'=>'required','class'=>'form-control']) }}
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