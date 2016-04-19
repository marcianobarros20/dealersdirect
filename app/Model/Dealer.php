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

}
