<html>
	<head></head>
	<body>
		<form action="{{ route('dealer.admins.update', ['update_id' =>$dealer_admin_details->id ]) }}" method="POST" enctype="multipart/form-data">
			<div align="center">
				<label>Type new Firstname:</label><br>
				<input type="text" value="{{$dealer_admin_details->first_name}}" name="new_fname"><br>
				<label>Type new lastname:</label><br>
				<input type="text" value="{{$dealer_admin_details->last_name}}" name="new_lname"><br>
				<label>Type new Zip:</label><br>
				<input type="text" value="{{$dealer_admin_details->dealer_details->zip}}" name="new_zip"><br>
				<label>Type new Phone Number:</label><br>
				<input type="text" value="{{$dealer_admin_details->dealer_details->phone}}" name="new_phone"><br>
				<label>Type new address:</label><br>
				<textarea name="new_address">{{$dealer_admin_details->dealer_details->address}}</textarea><br><br>
				<div>
		           <img src="{{ url('/')}}/public/dealers/{{$dealer_admin_details->dealer_details->image}}" title="car" alt="car" height="100px" width="100px" />
		        </div>
		        <input type="hidden" name="old_image" value="{{$dealer_admin_details->dealer_details->image}}">
		        <label>Upload New Image:</label><br><br>
		        <input type="file" name="new_image"><br><br>
		        <button type="submit" name="btn_submit">Update</button>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </div>
		</form>
	</body>
<html>