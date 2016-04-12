<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestQueue extends Model
{
    //
    public $timestamps = true;
	protected $table = 'request_queue';
	protected $guarded = array();
    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }
    public function models() {
        return $this->hasOne('App\Model\Carmodel', 'id', 'carmodel_id');
        }
    public function clients() {
        return $this->hasOne('App\Model\Client', 'id', 'client_id');
        }
    public function bids() {
        return $this->hasMany('App\Model\BidQueue', 'requestqueue_id')->where('visable','=',1);
        }
    public function options() {
        return $this->hasMany('App\Model\RequestStyleEngineTransmissionColor', 'requestqueue_id');
        }
    public function trade_ins(){
        return $this->hasOne('App\Model\TradeinRequest', 'request_queue_id','id');
    }
    public function request_dealer_log(){
        return $this->hasOne('App\Model\RequestDealerLog', 'request_id','id');
    }
}

