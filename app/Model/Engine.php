<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    //
    public $timestamps = true;
	protected $table = 'engine';
	protected $fillable=[
			'requestqueue_id',
			'style_id',
			'engine_id',
			'name',
			'equipmentType',
			'compressionRatio',
			'cylinder',
			'size',
			'displacement',
			'configuration',
			'fuelType',
			'horsepower',
			'torque',
			'totalValves',
			'type',
			'code',
			'compressorType',
			'rpm',
			'valve'
       ];
}
