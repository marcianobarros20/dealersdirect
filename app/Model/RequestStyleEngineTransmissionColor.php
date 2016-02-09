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
        'exterior_color_id',
        'interior_color_id',
        'count'
        ];
    public function styles() {
        return $this->hasOne('App\Model\Style', 'style_id', 'style_id');
    }
    public function engines() {
        return $this->hasOne('App\Model\Engine', 'engine_id', 'engine_id');
    }
    public function transmission() {
        return $this->hasOne('App\Model\Transmission', 'transmission_id', 'transmission_id');
    }
    public function excolor() {
        return $this->hasOne('App\Model\Color', 'color_id', 'exterior_color_id');
    }
    public function incolor() {
        return $this->hasOne('App\Model\Color', 'color_id', 'interior_color_id');
    }
    public function edmundsimage() {
        return $this->hasMany('App\Model\EdmundsStyleImage', 'style_id', 'style_id');
    }
}
