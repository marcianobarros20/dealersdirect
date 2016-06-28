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
            'make_id',
            'model_id',
            'year',
            'trim',
            'fuelImg_big_jpgformat',
            'fuelImg_small_jpgformat',
            'fuelImg_big_jpgformatlocal',
            'fuelImg_small_jpgformatlocal'
       ];
}
