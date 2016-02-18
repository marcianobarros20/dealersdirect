<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestQueue extends Model
{
    //
    public $timestamps = true;
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
    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
    }
}
