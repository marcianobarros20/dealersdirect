<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Caryear extends Model
{
    //
    public $timestamps = true;
	protected $table = 'caryear';
	protected $fillable=[
        'make_id',
        'carmodel_id',
        'year_id',
        'year',
        'styles'
       ];
}
