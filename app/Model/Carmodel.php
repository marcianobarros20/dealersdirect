<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    //
    public $timestamps = false;
	protected $table = 'carmodels';
	protected $fillable=[
        'model_id',
        'name',
        'nice_name',
        'years',
        'make_id'
       ];
       public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }
}
