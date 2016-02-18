@extends('front/layout/front_inner_template')
@section('content')
<!-- ================================================== TESTIMONIALS ================================================== -->
    <section class="space-top-and-bottom medium">
        <div class="container">

            <div class="row">

                <!-- body -->
                <div class="twelve columns" data-appear-animation="bounceIn">
                    <h2><b>Success</b></h2>
                    <p>Thanks {{ $RequestQueue->fname }} {{ $RequestQueue->lname }}</p>
                    <p>Your Request have been sent to the irrespective Dealers, you will be contacted as soon as possible for better options please SIGN-UP with us Or SKIP the Form Below</p>
                    <h3>SIGN-UP FORM</h3>

							<div class="twelve columns alpha space-top-and-bottom medium">
								<div style="border-radius:10px;background:#363f48; display:block;  width:100%;">
									<div style=" padding:20px; ">

										<div class="dark-form">
											{{ Form::open(array('url' => 'clientregister')) }}
												<fieldset>
													<div class="input">
													{{ Form::hidden('id',$RequestQueue->id,'') }}
														{{ Form::text('fname',$RequestQueue->fname,['placeholder' => 'First Name','required'=>'required']) }}
													</div>

													<div class="input">
														{{ Form::text('lname',$RequestQueue->lname,['placeholder' => 'Last Name','required'=>'required']) }}

													</div>
													<div class="input">
														{{ Form::text('phone',$RequestQueue->phone,['placeholder' => 'Phone','required'=>'required']) }}

													</div>
													<div class="input">
														{{ Form::text('email',$RequestQueue->email,['placeholder' => 'Email','required'=>'required']) }}

													</div>
													<div class="input">
														{{ Form::password('password',['placeholder' => 'Password','required'=>'required']) }}

													</div>
													<div class="input">
														{{ Form::password('conf_password',['placeholder' => 'Confirm-Password','required'=>'required']) }}

													</div>
												
													<div class="input-submit">
														{{ Form::submit('SIGN-UP',array('class' => '')) }}
													</div>
													<div class="button-wrap"> 
														<a href="#" class="button full orange"> 
														Skip 
														<span class="icon-arrow-right"></span> 
														</a> 
													</div>


												</fieldset>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							
							</div>
							<h3>Skip</h3>
                    
                </div>
                <!-- .body -->

            </div>

    </section>

    <!-- ================================================== END TESTIMONIALS ================================================== -->
@stop