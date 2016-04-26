<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestDealerLog extends Model
{
    //
    public $timestamps = true;
    protected $guarded = array();

    protected $table = 'request_dealer_log';
    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }
    public function dealers() {
        return $this->hasOne('App\Model\Dealer', 'id', 'dealer_id');
    }
    public function requestqueue() {
        return $this->hasOne('App\Model\RequestQueue', 'id', 'request_id');
    }
    public function bids() {
        return $this->hasMany('App\Model\BidQueue', 'requestqueue_id','request_id')->where('visable','=',1);
        }
}
