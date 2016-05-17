<p style="font-size:20px;line-height:22px;color:#1588d1;font-family:'Lato', sans-serif;font-weight:700;display:block;text-align: left;margin:0;margin-bottom:20px;display:block;">Hey You Have A Reminder Mail</p>
<p style="font-size:15px; line-height:20px;color:#4e4e4e;font-family:'Lato', sans-serif;font-weight:400;margin:0;margin-bottom:15px;display:block;text-align:left"> Reminder Note : {!!  $note !!}</p>
<p style="font-size:15px; line-height:20px;color:#4e4e4e;font-family:'Lato', sans-serif;font-weight:400;margin:0;margin-bottom:15px;display:block;text-align:left"> Reminder Date {!! date("dS M Y", strtotime($rdate)) !!},</p>
<p style="font-size:15px; line-height:20px;color:#4e4e4e;font-family:'Lato', sans-serif;font-weight:400;margin:0;margin-bottom:15px;display:block;text-align:left"> Reminder Time {!! date("h:i A", strtotime($rtime)) !!},</p>

<p style="font-size:15px; line-height:20px;color:#4e4e4e;font-family:'Lato', sans-serif;font-weight:400;margin:0;margin-bottom:15px;display:block;text-align:left">Please click on the bellow link to View The Details.</p>


<div style="font-size:16px;line-height:22px;color:#4e4e4e;font-family:'Lato', sans-serif;font-weight:700;background:#fff;border:1px solid #1588d1;border-radius:25px;  display: inline-block;margin-bottom:30px;">
 
Link: <a href="{!! $activateLink !!}" style="font-weight:400;font-style:italic;color:#1588d1;text-decoration:none;">{!! $activateLink !!}</a></p>
Or: <a href="{!! $activateLink !!}" style="font-weight:400;font-style:italic;color:#1588d1;text-decoration:none;">Click Here To See The Details</a></p>
</div>