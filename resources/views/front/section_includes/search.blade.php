<section class="home_select_area">
	<div class="container" id="searchfirst">
		<div class="col-xs-12 col-sm-12 col-md-12 select_option">
			<div class="new_btn">
				{{ Form::select('make_search', $Makes, '', array('id' => 'make_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('model_search', [''=>'Select Model'], '', array('id' => 'model_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('condition_search', [''=>'Select Condition'], '', array('id' => 'condition_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('year_search', [''=>'Select Year'], '', array('id' => 'year_search')) }}
			</div>
		</div> <!-- /row col-xs-12 select_option -->
		<div class="row home_next_btn">
			<div class="col-xs-12 col-sm-12 col-md-12" id="searchfirstnext" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="nextfirst" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
			</div>
		</div>
	</div><!--  /container -->
	<div class="container" id="searchseconed" style="display:none;">
		<div class="col-xs-12 col-sm-12 select_option">
			<div class="text_new_area" >
				{{ Form::text('tamo','', array('id' => 'tamo','class'=>'form-control form_in_control','placeholder'=>'Total Amount')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('mtamo','', array('id' => 'mtamo','class'=>'form-control form_in_control','placeholder'=>'Monthly Amount')) }}
			</div>
		</div> <!-- /row col-xs-12 select_option -->
		<div class="row home_next_btn">
			
			<div class="col-xs-12 col-sm-12 col-md-12" id="nextistwo" data-appear-animation="slideInRight">
				
				<button type="button"  id="backfirst" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button>
								
				<button type="button" id="nextsecond" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
							
			</div>
			
		</div>
	</div>
	<div class="container" id="searchthird" style="display:none;">
		<div class="home_next_btn">
			<div class="radio-div">
		        <div class="" id="trade-in" >
		          <h3>Trade In</h3>
		          <label class="radio-inline">
		          {{ Form::radio('tradein', 'yes', false, array('id'=>'yes')) }} Yes
		          </label>
		          <label class="radio-inline">
		          {{ Form::radio('tradein', 'no', false, array('id'=>'no')) }} No
		          </label>
		        </div>
		        <div class="" id="owe-money"style="display:none;" >
		          <h3>Owe Money</h3>
		          <label class="radio-inline">
		          {{ Form::radio('owe', '1', false, array('id'=>'1')) }} Yes
		          </label>
		          <label class="radio-inline">
		          {{ Form::radio('owe', '0', false, array('id'=>'0')) }} No
		          </label>
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12" >
				<button type="button"  id="backsecond" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-offset-5 col-md-4" id="nextis" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="nextfifth" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="tradeinowe" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="fourthownext" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-offset-5 col-md-4" id="tradein" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="fourthnext" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
				
			</div>
		</div>
	</div><!--  /container --> 
	<div class="container" id="searchfourth" style="display:none;">
		<div class="col-xs-12 col-sm-12 col-md-12 select_option">
			<div class="text_new_area" id="owediv" style="display: none;">
				{{ Form::text('oweamount','', array('id' => 'oweamount','class'=>'form-control form_in_control','placeholder'=>'OWE Amount')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('trademake_search', $Makes, '', array('id' => 'trademake_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('trademodel_search', [''=>'Select Model'], '', array('id' => 'trademodel_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('tradecondition_search', [''=>'Select Condition'], '', array('id' => 'tradecondition_search')) }}
			</div>
			<div class="new_btn">
				{{ Form::select('tradeyear_search', [''=>'Select Year'], '', array('id' => 'tradeyear_search')) }}
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" >
				<button type="button"  id="backthird" class="btn btn-warning next_btn_next ne-sear"><i class="fa fa-share-square-o"></i> Back</button>
			</div>
		</div> <!-- /row col-xs-12 select_option -->
		<!-- <div class="row home_next_btn"> -->
			
			<div class="col-xs-12 col-sm-12 col-md-12" id="tradenext" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="fifthnext" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
				
			</div>
			
		<!-- </div> -->
	</div><!--  /container --> 
	<div class="container" id="searchfifth" style="display:none;">
		<div class="col-xs-12 col-sm-12 select_option">
			<div class="text_new_area" >
				{{ Form::text('fname','', array('id' => 'fname','class'=>'form-control form_in_control','placeholder'=>'First Name')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('lname','', array('id' => 'lname','class'=>'form-control form_in_control','placeholder'=>'Last Name')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('phone','', array('id' => 'phone','class'=>'form-control form_in_control','placeholder'=>'Phone')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('email','', array('id' => 'email','class'=>'form-control form_in_control','placeholder'=>'Email')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('zip','', array('id' => 'zip','class'=>'form-control form_in_control','placeholder'=>'Zip')) }}
			</div>
		</div> <!-- /row col-xs-12 select_option -->
		<div class="col-xs-12 col-sm-12 col-md-12"  id="backfifth" style="display:none;">
				<button type="button"  id="four" class="btn btn-warning next_btn_next sea-btn"><i class="fa fa-share-square-o"></i> Back</button>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="fifthback" style="display:none;">
				<button type="button"  id="third" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button>
			</div>
		<div class="home_next_btn">
			
			<div class="col-xs-12 col-sm-12 col-md-12" id="donetes" data-appear-animation="slideInRight">
				
				<button type="button"  id="dstes" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Done</button>
				
				<button type="button" id="newdeset" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Request As A User</button>
				
				
			</div>
			
		</div>
	</div><!--  /container -->
	
</section>