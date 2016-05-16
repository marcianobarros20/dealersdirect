<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReminderLead extends Model
{
    //
    public $timestamps = true;
	protected $table = 'reminder_lead';
	protected $guarded = array();
}
