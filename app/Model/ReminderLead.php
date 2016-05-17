<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReminderLead extends Model
{
    //
    public $timestamps = true;
	protected $table = 'reminder_lead';
	protected $guarded = array();
	
    
    
    public function contact_details() {
        return $this->hasOne('App\Model\ContactList', 'id', 'contact_id');
    }
    public function lead_details() {
        return $this->hasOne('App\Model\LeadContact', 'id', 'lead_id');
    }
}
