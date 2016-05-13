		<?php //dd($ReminderLead) ?>
	@if($ReminderLeadcount!=0)
	@foreach($ReminderLead as $Reminder)
	<div class="notification">
		<a href="{{ url('/')}}/dealers/reminder/{{base64_encode($Reminder->id)}}"><i class="fa fa-flag" aria-hidden="true"></i>{{substr($Reminder->note,0,50).'...'}}</a>
		<span class="note-date">{{date("dS M Y", strtotime($Reminder->rdate))}}</span>
		<span class="note-time">{{date("h:i A", strtotime($Reminder->rtime))}}</span>
	</div>
	<div class="clear"></div>
	@endforeach
	<a class="viewall" href="{{ url('/')}}/dealers/reminder_list">View all <i class="fa fa-caret-right" aria-hidden="true"></i></a>
	@else
	Sorry No Reminder Set
	@endif
	