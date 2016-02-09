

<option selected="selected" value="">Any Model</option>
<?php 
foreach ($Carmodel as  $value) {
?><option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
<?php
}
?>
                
                       
