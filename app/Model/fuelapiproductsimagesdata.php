<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class fuelapiproductsimagesdata extends Model
{
    //
    public $timestamps = true;
	protected $table = 'fuelapiproductsimagesdata';
	protected $fillable=[
			'img_pid',
            'fuelImg_big_jpgformat',
            'fuelImg_small_jpgformat'
       ];
}
