<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BidQueue extends Model
{
    //
    public $timestamps = true;
	protected $table = 'bid_queue';
	protected $guarded = array();
	public function dealers() {
        return $this->hasOne('App\Model\Dealer', 'id', 'dealer_id');
        }
}
