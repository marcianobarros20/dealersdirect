<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    //
	public $timestamps = false;
	protected $table = 'makes';
	protected $fillable=[
        'makes_id',
        'name',
        'nice_name',
        'models'
       ];
}
