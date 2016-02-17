@extends('front/layout/dealer_template')
@section('content')
		
    <!-- ================================================== TESTIMONIALS ================================================== -->
<section class="space-top-and-bottom tiny">
<div class="container">
<div class="row">
<h3><b>Choose</b> New Make</h3>
<hr />


<div class="twelve columns alpha space-top-and-bottom tiny">
<div style="border-radius:10px;background:#363f48; display:block;  width:100%;">
<div style=" padding:20px; ">

<div class="dark-form">
{{ Form::open(array('url' => 'dealeraddmake')) }}
<fieldset>

<?php foreach ($Make as $key=>$value) {
    //echo $value;
?>
<div class="checkbox">
{{ Form::checkbox('agree[]', $key, null, array('id'=>$key)) }}
<label for="<?php echo $key; ?>"><?php echo $value; ?></label>
</div>
<?php }?>


<div class="input-submit">

{{ Form::submit('ADD',array('class' => '')) }}
</div>


</fieldset>
{!! Form::close() !!}
</div>
</div>
</div>

</div>


</div>
</div>
</section>

<!-- ================================================== END TESTIMONIALS ================================================== --> 


@stop