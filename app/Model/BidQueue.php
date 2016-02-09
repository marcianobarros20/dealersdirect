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
    public function request_queues() {
        return $this->hasOne('App\Model\RequestQueue', 'id', 'requestqueue_id');
        }
    public function bid_image() {
        return $this->hasMany('App\Model\BidImage', 'bid_id');
        }
    public function bid_acceptance_log() {
        return $this->hasOne('App\Model\BidAcceptanceQueue', 'bid_id');
        }
    public function bid_blocked_log() {
        return $this->hasOne('App\Model\BlockBidLog', 'bid_id');
        }
}
