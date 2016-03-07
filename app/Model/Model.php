<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Model extends Model
{
    //
    public $timestamps = false;
	protected $table = 'models';
	protected $fillable=[
        'model_id',
        'name',
        'nice_name',
        'years'
       ];
}
