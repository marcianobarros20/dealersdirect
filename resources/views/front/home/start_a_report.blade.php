@extends('front/layout/frontend_inner_template')
@section('content')
    
	<section>
		<div class="container">
			@if(Session::get('message'))
				<div class = "alert alert-danger">
					<a href = "#" class = "close" data-dismiss = "alert">
					&times;
					</a>
					<strong>{{Session::get('message')}}</strong> 
				</div>
			@endif
			<h2 class="head center-block">Report</h2>
			<div class="row">
				<div class="col-xs-12 sign_form">
					{{ Form::open(array('url' => '/sendreport','class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) }}
					
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Type</label>
							<div class="col-sm-9">
								{{ Form::select('type', array('Bug' => 'Bug', 'Request for Enhanchement' => 'Request for Enhancement')) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Severity</label>
							<div class="col-sm-9">
								{{ Form::select('severity', array('Minor' => 'Minor', 'Major' => 'Major')) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Priority</label>
							<div class="col-sm-9">
								{{ Form::select('priority', array('Normal' => 'Normal', 'High' => 'High')) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-9">
								{{ Form::text('name','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-9">
								{{ Form::text('email','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-9">
								{{ Form::text('phone','',['placeholder' => '','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-9">
								{{ Form::text('subject','',['placeholder' => '','required'=>'required','class'=>'form-control']) }}
							</div>
						</div>
						<div class="form-group">
									    <label for="new_image" class="col-sm-2 control-label">Attachment:</label>
								<div class="col-sm-9">
								<!--<imput type="file" name="attachedimage" class="form-control" /> -->
								{{ Form::file('attachimage', ['class'=>'form-control']) }}
									   
								</div>
						</div>
						<div class="form-group">
							<label for="inputName3" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								{{ Form::textarea('details','',['class'=>'form-control profile_control','rows'=>'5','required'=>'required']) }}
							</div>
						</div>
						 
						  
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-9">
								{{ Form::submit('SEND',array('class' => 'btn btn-default btn-lg btn-block sign_btn')) }}
							</div>
						</div>
						
					{!! Form::close() !!}
				</div>	
			</div>
		</div>
	</section>

@stop