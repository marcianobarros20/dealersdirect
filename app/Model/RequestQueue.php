<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestQueue extends Model
{
    //
    public $timestamps = false;
	protected $table = 'request_queue';
	protected $fillable=[
        'make_id',
        'carmodel_id',
        'condition',
        'year',
        'total_amount',
        'monthly_amount',
        'fname',
        'lname',
        'phone',
        'email',
       ];
}
