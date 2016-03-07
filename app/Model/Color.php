<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    public $timestamps = true;
	protected $table = 'colors';
	protected $fillable=[
			'requestqueue_id',
            'style_id',
            'color_id',
            'category',
            'name',
            'manufactureOptionName',
            'hex',
            'rgb'
       ];
}
