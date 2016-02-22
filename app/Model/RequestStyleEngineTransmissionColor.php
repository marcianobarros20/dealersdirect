<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestStyleEngineTransmissionColor extends Model
{
    //
    public $timestamps = true;
	protected $table = 'request_styles_engine_transmission_color';
	protected $fillable=[
        'requestqueue_id',
        'style_id',
        'engine_id',
        'transmission_id',
        'color_id',
        'count'
        ];
}
