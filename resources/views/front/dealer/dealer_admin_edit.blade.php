@extends('front/layout/dealerfrontend_template')
@section('content')		
 <section>
	<div class="container pro-file-bla">
	  <h2 class="profile_head center-block">EDIT DETAILS</h2>
	    <div class="profile_details">
		    <div class="col-xs-12 profile_form">
		     	<div id="content">
			        <ul id="tabs" class="nav nav-tabs profile-browse" data-tabs="tabs">
				        <li class="active"><a href="#red" data-toggle="tab">Details</a></li>
				        <li><a href="#orange" data-toggle="tab">Change Password</a></li>
			        </ul>
			        <div id="my-tab-content" class="tab-content">
				        <div class="tab-pane active form-head" id="red">
				            <form action="{{ route('dealer.admins.update', ['update_id' =>$dealer_admin_details->id ]) }}" method="POST" enctype="multipart/form-data">
				            	<h3>Change Details</h3>
								<div class="form_back">
				              		<div class="form-group">
									    <label for="new_fname">Firstname:</label>
									    <input type="text" value="{{$dealer_admin_details->first_name}}" name="new_fname" class="form-control profile_control">
								  	</div>
									<div class="form-group">
										<label for="new_lname">Lastname:</label>
										<input type="text" value="{{$dealer_admin_details->last_name}}" name="new_lname" class="form-control profile_control">
									</div>
									<div class="form-group">
									    <label for="new_zip">Zip:</label>
									    <input type="text" value="{{$dealer_admin_details->dealer_details->zip}}" name="new_zip" class="form-control profile_control">
									</div>
									
									<div class="form-group">
									    <label for="new_phone">Phone Number:</label>
									    <input type="text" value="{{$dealer_admin_details->dealer_details->phone}}" name="new_phone" class="form-control profile_control">
									</div>
									<div class="form-group">
										<label for="new_address">Address:</label>
										<textarea name="new_address" class="form-control profile_control">{{$dealer_admin_details->dealer_details->address}}</textarea>
									</div>
									<div class="form-group">
									    <label for="new_image">Upload New Image:</label>
									   <input type="file" name="new_image" class="form-control profile_control">
									</div>
									
								    <input type="hidden" name="old_image" value="{{$dealer_admin_details->dealer_details->image}}">  
								    <button type="submit" name="btn_submit" class ="btn btn-default btn-lg btn-block">Update</button>
		        					<input type="hidden" name="_token" value="{{ Session::token() }}">
								</div> <!-- /form_back -->
							
				        </div>
				        <div class="tab-pane form-head" id="orange">
				            <!-- {{ Form::open(array('url' => 'dealereditpassword')) }}
				            	<h3>Change Password</h3>
								<div class="form_back">
				              		<div class="form-group">
									    <label for="exampleInputPassword1">Password</label>
									    
									    {{ Form::password('password',['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
									<div class="form-group">
									    <label for="exampleInputPassword1">Confirm Password</label>
									    {{ Form::password('conf_password',['class' => 'form-control profile_control','required'=>'required']) }}
									</div>
								        
								        {{ Form::submit('EDIT',array('class' => 'btn btn-default btn-lg btn-block')) }}
								</div> 
							{!! Form::close() !!} -->
				        </div>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
</section>


@stop