<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DealerMakeMap extends Model
{
    //
     public $timestamps = false;
    protected $fillable = array('dealer_id', 'make_id');

    protected $table = 'dealers_makes_map';

    public function dealers() {
        return $this->hasOne('App\Model\Dealer', 'id', 'dealer_id');
    }

    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }

}
