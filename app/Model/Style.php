<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    public $timestamps = true;
	protected $table = 'styles';
	protected $fillable=[
        'year_id',
        'style_id',
        'name',
        'body',
        'trim',
        'make_id',
        'carmodel_id',
        'submodel',
        'price',
       ];
}
