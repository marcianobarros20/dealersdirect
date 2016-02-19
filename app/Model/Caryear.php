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
    public function makes() {
        return $this->hasOne('App\Model\Make', 'id', 'make_id');
        }
    public function models() {
        return $this->hasOne('App\Model\Carmodel', 'id', 'carmodel_id');
        }
}
