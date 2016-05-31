<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DealersInfo extends Model
{
    public $timestamps = true;
	protected $table = 'dealers_info';
	protected $guarded = array();

public function dealer(){
        return $this->belongsTo('App\Model\Dealer','id');
  
    }	
    
}
