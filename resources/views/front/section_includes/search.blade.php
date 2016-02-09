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
		<div class="home_next_btn">
			<div class="col-xs-12 col-sm-12 col-md-12" id="searchfirstnext" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="nextfirst" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
			</div>
		</div>
	</div><!--  /container -->
	<div class="container" id="searchseconed" style="display:none;">
		<div class="col-xs-12 col-sm-12 select_option"  id="amortaization">
			<div class="text_new_area" id="minauto">

			</div>
			 <div class="text_new_area" id="toto">
			<!--TO --> &nbsp;
			</div>
			<div class="text_new_area" id="maxauto">
			</div>
		</div>


		<!-- Disclaimer Data @R on 21 June 2016 -->


		<div class="col-xs-12 col-sm-12">

			<div class="disclaimer_data" id="disclaimer_data" style="color:#F26722; font-weight: bold;">

			

			

			</div>


			@foreach($loan_details as $loan)

			<input type="hidden" id="rateofinterest" name="rate" value="{{$loan->rateofinterest}}">
			<input type="hidden" id="terms" name="terms" value="{{$loan->terms}}">

			@endforeach

		</div>

		<!-- END -->
		<div class="col-xs-12 col-sm-12 select_option">

		<div id="form_response"> </div>
			
			<div class="text_new_area" >
				{{ Form::text('tamo','', array('id' => 'tamo','class'=>'form-control form_in_control','placeholder'=>'Total Amount')) }}
			</div>
			<div class="text_new_area" >
				{{ Form::text('mtamo','', array('id' => 'mtamo','class'=>'form-control form_in_control','placeholder'=>'Monthly Amount')) }}
			</div><br>
			<div class="amortization-calculator">
				<a data-toggle="modal" data-target="#amortization-cal" href="#"><i class="fa fa-calculator" aria-hidden="true" data-toggle="tooltip" title="Amortization Calculator"></i> Amortization Calculator</a>
			</div>
		</div> <!-- /row col-xs-12 select_option -->
		<div class="home_next_btn">
			
			<div class="col-xs-12 col-sm-12 col-md-12" id="nextistwo" data-appear-animation="slideInRight">
				
				<button type="button"  id="backfirst" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button><br>
								
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
			<div class="col-xs-12 col-sm-12 col-md-12" id="nextis" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="nextfifth" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="tradeinowe" style="display:none;" data-appear-animation="slideInRight">
				<button type="button" id="fourthownext" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Next</button>
				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="tradein" style="display:none;" data-appear-animation="slideInRight">
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
	</div><!--  //container --> 
	<div class="container" id="searchfifth" style="display:none;">
		<div class="col-xs-12 col-sm-12 col-md-12 top-overview-box">
			<!-- <h2>Overview</h2> -->
			<div class="overview-box-section">
				
				<!-- <div class="overview-box setslider">
					
				</div> -->
				

				<div class="overview-box setsliderNew">
					
				</div>

				<div class="overview-box">
					<p id="carselect">New 2015 audi</p>
					<p id="fmsrfp">Msrp range: <span class="overview-values" id="minmsrp">3431</span> - <span class="overview-values"  id="maxmsrp">12345</span></p>
					<p id="fmp">Monthly payment: <span class="overview-values" id="minmp">3431</span> - <span class="overview-values"  id="maxmp">12345</span></p>
					<p><span class="budget-label">Total budget:</span> <span class="overview-values " id="tb">3431</span><span class="tooltiptext" id="tttb">Tooltip text</span></p>
					<p><span class="budget-label">Monthly amount:</span> <span class="overview-values "  id="mb">3431</span><span class="tooltiptext" id="ttmb">Tooltip text</span></p>
					<a href="#" class="overview-edit" id="upbudget">Update Budget</a>
				</div>
				<div class="overview-box">
					<div id="backfifth" style="display:none;">
					    <button type="button"  id="four" class="btn btn-warning next_btn_next sea-btn"><i class="fa fa-share-square-o"></i> Back</button>
					</div>
					<div id="fifthback" style="display:none;">
						<button type="button"  id="third" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button>
					</div>
					<div class="home_next_btn">
						
						<div id="donetes" data-appear-animation="slideInRight">
							
							<button type="button"  id="dstes" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Sign Up</button><br>
							
							<button type="button" id="newdeset" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Sign In</button>
							
							
						</div>
						
					</div>
				</div>
			</div>	
		</div>
		<!-- <div class="col-xs-12 col-sm-12 col-md-12"  id="backfifth" style="display:none;">
				<button type="button"  id="four" class="btn btn-warning next_btn_next sea-btn"><i class="fa fa-share-square-o"></i> Back</button>
		</div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="fifthback" style="display:none;">
				<button type="button"  id="third" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Back</button>
			</div>
		<div class="home_next_btn">
			
			<div class="col-xs-12 col-sm-12 col-md-12" id="donetes" data-appear-animation="slideInRight">
				
				<button type="button"  id="dstes" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Sign Up</button><br>
				
				<button type="button" id="newdeset" class="btn btn-warning next_btn_next"><i class="fa fa-share-square-o"></i> Sign In</button>
			</div>
		</div> -->
	</div><!--  /container -->
	
</section>


<!-- Modal -->
<div id="amortization-cal" class="modal fade" role="dialog">
  

  
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close_btn" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Amortization Calculator</h4>
      </div>

      <div class="modal-body">



        <form class="form-horizontal" method='post'>
         

         <div class="row"><div class="col-md-6 col-sm-6">

         <!-- Text input-->
	   <div class="control-group">
  	     <label class="control-label" for="loan_amount">Loan Amount ($) : </label>
  	    <div class="controls">
    	  <input id="loan_amount" name="loan_amount" type="text" placeholder="$" class="input-medium">
	    </div>
		</div>
		<!-- Text input-->
	   <div class="control-group">
  	     <label class="control-label" for="loan_term">Loan Term (Years) : </label>
  	    <div class="controls">
    	  <input id="loan_term" name="loan_term" type="text" placeholder="Years" class="input-medium">
	    </div>
		</div>
			<!-- Text input-->
	   <div class="control-group">
  	     <label class="control-label" for="interest_rate">Interest Rate (%) : </label>
  	    <div class="controls">
    	  <input id="interest_rate" name="interest_rate" type="text" placeholder="%" class="input-medium">
	    </div>
		</div>

		<div class="control-group hide" id="monthly_value"> 
  	     <label class="control-label" for="monthly_val">Monthly Value:</label>
  	    <div class="controls">
    	  <input id="monthly_val" name="monthly_val" type="text" class="input-medium" readonly>
	    </div>
		</div>
		
		
		</br>
		<!-- Button -->
		<div class="control-group">
  		<div class="controls">
    		<button type='button' id="calculate" name="calculate" class="btn btn-success">Calculate</button>
  		</div>
		</div>
		

		</div>



		<div class="col-md-6 col-lg-6">
			
			<div id="minauto_value"></div><br/><br/>
			<div id="maxauto_value"></div>
  

		</div>


		</div>




		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="close_btn" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  

</div>


<!-- Slider -->




 



<!--jquery for the calculator -->
<script type="text/javascript">
	$('#calculate').click(function (){
	var loan_amount=$('#loan_amount').val();
	var interest_rate=$('#interest_rate').val();
	var loan_term=$('#loan_term').val();
	var min_amt = $('#min_amt').val();
	var max_amt = $('#max_amt').val();

		//Calculate Value on base of Minimum Amount Custom Interest Rate Begin
		var months= loan_term*12;
        var rate_of_interest=(interest_rate/100)/12;
        var up=rate_of_interest*Math.pow((rate_of_interest+1),months);
        var down=(Math.pow((rate_of_interest+1),months))-1;
        var min_monthly_rate=parseFloat(min_amt*(up/down)).toFixed(2);

		//END


		//Calculate Value on base of Maximum Amount Custom Interest Rate Begin
		var months= loan_term*12;
        var rate_of_interest=(interest_rate/100)/12;
        var up=rate_of_interest*Math.pow((rate_of_interest+1),months);
        var down=(Math.pow((rate_of_interest+1),months))-1;
        var max_monthly_rate=parseFloat(max_amt*(up/down)).toFixed(2);

		//END


		$.ajax({
            url: "<?php echo url('/');?>/ajax/amortization_cal",
            data: {loan_amount:loan_amount,interest_rate:interest_rate,loan_term:loan_term,_token: '{!! csrf_token() !!}'},
            type :"post",
            success: function( data ) {
            $('#monthly_value').removeClass('hide');
            $('#monthly_val').val(data);
            var monthly_val = $('#monthly_val').val();
            var loan_term = $('#loan_term').val();
			var interest_rate = $('#interest_rate').val();
            $('#mtamo').val(monthly_val);
            $("#disclaimer_data").html("*Amount shown as " + interest_rate+"% interest per year for "+loan_term+" years.");
            $('#minauto_value').html("<b>Minimum Price</b><br/><b>Total :</b> $"+min_amt+"<br/><b>Monthly:</b> $"+ min_monthly_rate);
            $('#maxauto_value').html("<b>Maximum Price</b><br/><b>Total :</b> $"+max_amt+"<br/><b>Monthly:</b> $"+ max_monthly_rate);


            $('#minauto').html("<b>Minimum Price</b><br/><b>Total :</b> $"+min_amt+"<br/><b>Monthly:</b> $"+ min_monthly_rate);
            $('#maxauto').html("<b>Maximum Price</b><br/><b>Total :</b> $"+max_amt+"<br/><b>Monthly:</b> $"+ max_monthly_rate);


           }
        });
	});	


	  // Mortgage Calculator script for taking value 

   $(document).ready(function(){
		 $('.amortization-calculator').click(function(){ 
			var custom_amount = $('#tamo').val();
			
			//alert (custom_amount);
		    $('#loan_amount').val(custom_amount);
	       });



	

   });





</script>






