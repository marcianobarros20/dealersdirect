<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeadContact extends Model
{
    //
    public $timestamps = true;
	protected $table = 'lead_contacts';
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
    public function contact_details() {
        return $this->hasOne('App\Model\ContactList', 'id', 'contact_id');
    }
    public function dealer_details(){
        return $this->hasOne('App\Model\DealerDetail','dealer_id','id');
  
    }
    public function dealer_info(){
        return $this->hasOne('App\Model\DealersInfo','dealer_id','dealer_id');
  
    }
    public function dealer(){
        return $this->hasOne('App\Model\Dealer','id','dealer_id');
  
    }
}
