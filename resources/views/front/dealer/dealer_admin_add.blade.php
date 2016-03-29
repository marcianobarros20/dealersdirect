@extends('front/layout/dealer_template')
@section('content')

<section class="space-top-and-bottom tiny">
	<div class="container">
		<div class="row">
			<h3><b>Add</b> Admin</h3>
			<hr />


			<div class="twelve columns alpha space-top-and-bottom tiny">
				<div style="border-radius:10px;background:#363f48; display:block;  width:100%;">
					<div style=" padding:20px; ">

						<div class="dark-form">
							{{ Form::open(array('url' => 'dealers/dealer_add_admin', 'files'=>true)) }}
								<fieldset>
									<div class="input">
										{{ Form::text('fname','',['placeholder' => 'First Name','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::text('lname','',['placeholder' => 'Last Name','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::text('email','',['placeholder' => 'Email','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::password('password',['placeholder' => 'Password','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::password('conf_password',['placeholder' => 'Confirm-Password','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::text('zip','',['placeholder' => 'Zip Code','required'=>'required']) }}
									</div>
									<div class="input">
										{{ Form::text('phone','',['placeholder' => 'Phone Number','required'=>'required']) }}
									</div>
									<div class="input">
										{!! Form::file('images') !!}
									</div>
									<div class="textarea">
										{{ Form::textarea('address','',['placeholder' => 'Address','required'=>'required']) }}
									</div>							

									<div class="input-submit">
										{{ Form::submit('ADD ADMIN',array('class' => '')) }}
									</div>


								</fieldset>
							{!! Form::close() !!}
						</div>
					</div>
				</div>

			</div>


		</div>
	</div>
</section>

@stop