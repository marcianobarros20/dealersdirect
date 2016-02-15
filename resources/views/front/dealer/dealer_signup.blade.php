@extends('front/layout/dealer_signup_template')
@section('content')
		<section>
			<div class="dark-promo">
					<div class="container">
						<div class="row">
							<div class="promo dark">
							<h1 data-appear-animation="flipInX">Sign Up As A Dealer</h1>
									<div class="dark-form">
									
									<div class="send_result"></div>
										<!-- <form class="contactform" method="post" action="contact_process.php"> -->
										{{ Form::open(array('url' => 'dealerregister')) }}
											<fieldset>
												<div class="twelve columns alpha">

													<div class="input">
														
														{{ Form::text('fname','',['placeholder' => 'First Name']) }}
													</div>

													<div class="input">
													{{ Form::text('lname','',['placeholder' => 'Last Name']) }}
													
													</div>
													<div class="input">
													{{ Form::text('email','',['placeholder' => 'Email']) }}
													
													</div>
													<div class="input">
													{{ Form::password('password',['placeholder' => 'Password']) }}
													
													</div>
													<div class="input">
													{{ Form::password('conf_password',['placeholder' => 'Confirm-Password']) }}
													
													</div>
														<div class="side-by-side clearfix">
														{{ Form::select('make[]', $Makes,'',array('data-placeholder' => 'Choose Make...','class' =>'chosen-select','multiple' => true)) }}
															
														</div>
												</div>
												
												<div class="twelve columns alpha">
													<div class="input-submit">
														
														{{ Form::submit('SIGN-UP',array('class' => '')) }}
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