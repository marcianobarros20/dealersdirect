<form action="<?php echo URL::to('client/update-budget'); ?>" method="post">
<table class="table table-responsive">
	<tbody>
		<tr>
			<td>
				TOTAL AMOUNT :
			</td>
			<td>
				<input type="text" class="form-control input-md" name="totalvalue" value="{{$RequestQueue->total_amount}}">	
			</td>
		</tr>
		<tr>
			<td>
				MONTHLY AMOUNT:
			</td>
			<td>
				<input type="text" class="form-control input-md" name="monthlyvalue" value="{{$RequestQueue->monthly_amount}}">	
			</td>
		</tr>
	</tbody>
</table>
<input type='hidden' name='req_id' value='{{$RequestQueue->id}}'>
<button class='btn btn-success' type='submit'>Update</button>
</form>