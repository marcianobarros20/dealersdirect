<label for="exampleInputEmail1">City</label>
{{ Form::select('city_id', $City,'',array('data-placeholder' => 'Choose City...','id'=>'city_id', 'required' => 'required')) }}