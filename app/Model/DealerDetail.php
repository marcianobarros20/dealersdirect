<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DealerDetail extends Model
{
    //
    public $timestamps = true;
    

    protected $guarded = array();  

    protected $table = 'dealer_details';
    public function dealer_state(){
        return $this->hasOne('App\Model\State', 'id','state_id');
  
    }
    public function dealer_city(){
        return $this->hasOne('App\Model\City','id', 'city_id');
  
    }
}
