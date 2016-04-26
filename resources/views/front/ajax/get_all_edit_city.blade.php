<label for="exampleInputName1">City</label>
{{ Form::select('city_id', $City,'',array('class' => 'form-control profile_control','id'=>'city_id', 'required' => 'required')) }}