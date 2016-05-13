<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Dealer extends Model
{
    //
     public $timestamps = true;
    

    protected $guarded = array();  

    protected $table = 'dealers';
    public function makes() {
        return $this->belongsToMany('App\Model\Make','dealers_makes_map', 'dealer_id', 'make_id');
    }
    public function dealer_details(){
        return $this->hasOne('App\Model\DealerDetail', 'dealer_id','id');
  
    }
   public function dealer_parent(){
        return $this->hasOne('App\Model\Dealer', 'id','parent_id');
  
    }
    public function dealer_bid_info(){
        return $this->hasOne('App\Model\DealersAdminBidManagement','dealer_id','id');
  
    }   

}
