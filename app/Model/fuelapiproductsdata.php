<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class fuelapiproductsdata extends Model
{
    //
    public $timestamps = true;
	protected $table = 'fuelapiproductsdata';
	protected $fillable=[
			'make_id',
            'model_id',
            'year',
            'product_id',
            'trim',
            'body'
       ];
     //
}
