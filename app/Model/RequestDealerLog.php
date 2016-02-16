<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestDealerLog extends Model
{
    //
    public $timestamps = true;
    protected $fillable = array('dealer_id','request_id','status', 'make_id');

    protected $table = 'request_dealer_log';
    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }
    public function requestqueue() {
        return $this->hasOne('App\Model\RequestQueue', 'id', 'request_id');
    }
}
