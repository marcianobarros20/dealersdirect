@extends('front/layout/client_template')
@section('content')
		
 <!-- ================================================== TESTIMONIALS ================================================== -->
	<section class="space-top-and-bottom tiny">
		<div class="container">
			<div class="row">

				<h3>
					<b>Profile & Details</b>
				</h3>
				<hr />
				<div class="send_result" style="padding-bottom: 2%;">{!! Session::get('message') !!}</div>
				<!-- horizontal tabs -->
				<div class="twelve columns alpha">
					
					<div class="h-tab">
						<ul class="resp-tabs-list clearfix">
							<li>Details</li>
							<li>Change Password</li>
						</ul>
						<!-- .nav -->

						<!-- container -->
						<div class="resp-tabs-container">

							<!-- 1 -->
							<div class="tab-content">
								<h4>Change Details</h4>
										<div style="border-radius:10px;background:#363f48; display:block;  width:100%;">
											<div style=" padding:20px; ">

												<div class="dark-form">
												{{ Form::open(array('url' => 'clienteditdetails','id'=>'cliedit')) }}
													<fieldset>
														<div class="label">
															Email/User Name
														</div>
														<div class="input">
															
															{{ Form::text('email',$Client->email,['placeholder' => 'Email/User Name','readonly' => 'true']) }}
														</div>
														<div class="label">
															First Name
														</div>
														<div class="input">
															{{ Form::text('fname',$Client->first_name,['placeholder' => 'First Name','required'=>'required']) }}
														</div>
														<div class="label">
															Last Name
														</div>
														<div class="input">
															{{ Form::text('lname',$Client->last_name,['placeholder' => 'Last Name','required'=>'required']) }}
														</div>
														<div class="label">
															Phone
														</div>
														<div class="input">
															{{ Form::text('phone',$Client->phone,['placeholder' => 'Phone','required'=>'required']) }}
														</div>
														<div class="input">
															{{ Form::text('zip',$Client->zip,['placeholder' => 'Zip','required'=>'required']) }}
														</div>
														<div class="input-submit">
															{{ Form::submit('EDIT',array('class' => '')) }}
														</div>


													</fieldset>
												{!! Form::close() !!}
												</div>
											</div>
										</div>

									
							</div>
							<!-- .1 -->

							<!-- 2 -->
							<div class="tab-content">
								<h4>Change Password</h4>
										<div style="border-radius:10px;background:#363f48; display:block;  width:100%;">
											<div style=" padding:20px; ">

												<div class="dark-form">
												{{ Form::open(array('url' => 'clienteditpassword')) }}
													<fieldset>
														<div class="input">
															{{ Form::password('password',['placeholder' => 'Password','required'=>'required']) }}
														</div>
														<div class="input">
															{{ Form::password('conf_password',['placeholder' => 'Confirm-Password','required'=>'required']) }}
														</div>
														
														<div class="input-submit">
															{{ Form::submit('EDIT',array('class' => '')) }}
														</div>


													</fieldset>
												{!! Form::close() !!}
												</div>
											</div>
										</div>
							</div>
							<!-- .2 -->



						</div>
						<!-- container -->

					</div>

				</div>
				<!-- .horizontal tabs -->




			</div>

		</div>
		
	</section>

<!-- ================================================== END TESTIMONIALS ================================================== --> 


@stop