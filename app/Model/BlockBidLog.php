<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlockBidLog extends Model
{
    //
    public $timestamps = true;
	protected $table = 'block_bid_log';
	protected $guarded = array();
}
