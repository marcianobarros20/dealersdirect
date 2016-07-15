@if($details_of_actions_value==1)
<div class="alert alert-info">
  <strong>Your Bid has been accepted!</strong>
</div>
@endif
@if($details_of_actions_value==0)
<div class="alert alert-danger">
  <strong>Your Bid has been rejected!</strong>
</div>
@endif
@if($details_of_actions_value==4)
<div class="alert alert-info">
  <strong>Success SALE!</strong>
</div>
@endif
@if($details_of_actions_value==3)
<div class="alert alert-danger">
  <strong>Lost SALE!</strong>
</div>
@endif