<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    //
    public $timestamps = true;
	protected $table = 'contact_list';
	protected $guarded = array();
	public function request_details() {
        return $this->hasOne('App\Model\RequestQueue', 'id', 'request_id');
    }
    public function bid_details() {
        return $this->hasOne('App\Model\BidQueue', 'id', 'bid_id');
    }
    public function client_details() {
        return $this->hasOne('App\Model\Client', 'id', 'client_id');
    }
    
}
