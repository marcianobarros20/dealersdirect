@extends('front/layout/client_signup_template')
@section('content')
		<section>
			<div class="dark-promo">
					<div class="container">
						<div class="row">
							<div class="promo dark">
							<h1 data-appear-animation="flipInX">Sign In As A Client</h1>
									<div class="dark-form">
									
									<div class="send_result">{!! Session::get('error') !!}</div>
										<!-- <form class="contactform" method="post" action="contact_process.php"> -->
										{{ Form::open(array('url' => 'client-signin')) }}
											<fieldset>
												<div class="twelve columns alpha">

													<div class="input">
														<!-- <input type="text" placeholder="Email" name="email"/> -->
														{{ Form::text('email','',['placeholder' => 'Email','required'=>'required']) }}
													</div>

													<div class="input">
														<!-- <input type="password" placeholder="Password" name="password" /> -->
														{{ Form::password('password',['placeholder' => 'Password','required'=>'required']) }}
													</div>
													
												</div>
												
												<div class="twelve columns alpha">
													<div class="input-submit">
														<!-- <input type="submit" value="SIGN-IN" class="submitform" /> -->
														{{ Form::submit('SIGN-IN',array('class' => '')) }}
														
													</div>
												</div>

											</fieldset>
										{!! Form::close() !!}
									</div>
									<div class="row">

                    <div class="twelve columns alpha" data-appear-animation="slideInLeft">
                        <h6>
                            <span class=""></span><b>Want A Client Account ? <!-- <a href="<?php //echo url('/');?>/client-signup"> -->Sign up now!<!-- </a> --></b>
                        </h6>
                        
                    </div>

                    


                    


                </div>
							</div>
						</div>
					</div>
			</div>
		</section>

@stop