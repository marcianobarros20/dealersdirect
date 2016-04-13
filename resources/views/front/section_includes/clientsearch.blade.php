<section class="selection_area">
	<div class="container" id="firsc" >
		<div class="row select_option">
		<div class="profile_btn">
			{{ Form::select('make_search', $Makes, '', array('id' => 'make_search')) }}
		</div>
		<div class="profile_btn">
			{{ Form::select('model_search', [''=>'Select Model'], '', array('id' => 'model_search')) }}
		</div>
		<div class="profile_btn">
			{{ Form::select('condition_search', [''=>'Select Condition','New'=>'New','Used'=>'Used'], '', array('id' => 'condition_search')) }}
		</div>
		<div class="profile_btn">
			{{ Form::select('year_search', [''=>'Select Year'], '', array('id' => 'year_search')) }}
		</div>
		<div class="further_proceed_options" id="trade-in" style="display:none;">
			<h3>Trade In</h3>
			<div class="radio">
				<label>
				{{ Form::radio('tradein', 'yes', false, array('id'=>'yes')) }} Yes
				</label>
			</div>
			<div class="radio">
				<label>
				{{ Form::radio('tradein', 'no', false, array('id'=>'no')) }} No
				</label>
			</div>
		</div>
		<div class="further_proceed_options" id="owe-money" style="display:none;" >
			<h3>Owe Money</h3>
			<div class="radio">
				<label>
					{{ Form::radio('owe', '1', false, array('id'=>'1')) }} Yes
				</label>
			</div>
			<div class="radio">
				<label>
					{{ Form::radio('owe', '0', false, array('id'=>'0')) }} No
				</label>
			</div>
		</div>
		</div>
		<div class="col-xs-12 next_button_area"  id="nextis" style="display:none;" >
				<button type="button"  id="plsnexii"  class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Next</button>
		</div>
		<div class="col-xs-12 next_button_area"  id="tradeinowe" style="display:none;" >
				<button type="button" id="tradeinowenex"  class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Next</button>
		</div>
		<div class="col-xs-12 next_button_area"  id="tradein" style="display:none;" >
				<button type="button"  id="tradeinnex" class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Next</button>

		</div>
	</div>
	<div class="container"  id="tradefirsc" style="display:none;" >
		<div class="row select_option">
		<div class="col-xs-2 text_new_area" id="owediv" style="display: none;">
				{{ Form::text('oweamount','', array('id' => 'oweamount','class'=>'form-control form_in_control','placeholder'=>'OWE Amount')) }}
		</div>
		<div class="col-xs-2 profile_btn">
			{{ Form::select('trademake_search', $Makes, '', array('id' => 'trademake_search')) }}
		</div>
		<div class="col-xs-2 profile_btn">
			{{ Form::select('trademodel_search', [''=>'Select Model'], '', array('id' => 'trademodel_search')) }}
		</div>
		<div class="col-xs-2 profile_btn">
			{{ Form::select('tradecondition_search', [''=>'Select Condition','New'=>'New','Used'=>'Used'], '', array('id' => 'tradecondition_search')) }}
		</div>
		<div class="col-xs-2 profile_btn">
			{{ Form::select('tradeyear_search', [''=>'Select Year'], '', array('id' => 'tradeyear_search')) }}
		</div>
		
		</div>
		<div class="col-xs-12 next_button_area"   id="tradenext" style="display:none;"  >
				<button type="button"  id="plsnexxx"  class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Next</button>
		</div>
	</div>
	<div class="container"  id="secsc" style="display:none;" >
		<div class="row select_option">
		<div class="col-xs-2 text_new_area">
				{{ Form::text('tamo','', array('id' => 'tamo','class'=>'form-control form_in_control','placeholder'=>'Total Amount')) }}
		</div>
		<div class="col-xs-2 text_new_area">
				{{ Form::text('mtamo','', array('id' => 'mtamo','class'=>'form-control form_in_control','placeholder'=>'Monthly Amount')) }}
		</div>
		
		</div>
		<div class="col-xs-12 next_button_area"  id="nextistwo">
				@if($client!=0)
				<button type="button"  id="sinses" class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Done</button>
				@else
				<button type="button" id="npllses" class="btn btn-warning next_btn"><i class="fa fa-share-square-o"></i> Next</button>
				@endif
		</div>
	</div>
</section>