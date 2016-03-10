<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BidAcceptanceQueue extends Model
{
    //
     public $timestamps = true;
	protected $table = 'bid_acceptance_log';
	protected $guarded = array();
}
