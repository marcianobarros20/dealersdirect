<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeinRequest extends Model
{
    //
    public $timestamps = true;
	protected $table = 'tradein_request_queue';
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
    
}
