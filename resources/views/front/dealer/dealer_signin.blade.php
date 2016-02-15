@extends('front/layout/dealer_signup_template')
@section('content')
		<section>
			<div class="dark-promo">
					<div class="container">
						<div class="row">
							<div class="promo dark">
							<h1 data-appear-animation="flipInX">Sign In As A Dealer</h1>
									<div class="dark-form">
									
									<div class="send_result"></div>
										<!-- <form class="contactform" method="post" action="contact_process.php"> -->
										{{ Form::open(array('url' => 'dealer-signin')) }}
											<fieldset>
												<div class="twelve columns alpha">

													<div class="input">
														<!-- <input type="text" placeholder="Email" name="email"/> -->
														{{ Form::text('email','',['placeholder' => 'Email']) }}
													</div>

													<div class="input">
														<!-- <input type="password" placeholder="Password" name="password" /> -->
														{{ Form::password('password',['placeholder' => 'Password']) }}
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
                            <span class=""></span><b>Want A Dealer Account ? <a href="<?php echo url('/');?>/dealer-signup">Sign up now!</a></b>
                        </h6>
                        
                    </div>

                    


                    


                </div>
							</div>
						</div>
					</div>
			</div>
		</section>

@stop