<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    //
    public $timestamps = true;
	protected $table = 'transmissions';
	protected $fillable=[
			'requestqueue_id',
            'style_id',
            'transmission_id',
            'name',
            'equipmentType',
            'transmissionType',
            'numberOfSpeeds'
       ];
}
