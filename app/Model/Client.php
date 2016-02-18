<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
     public $timestamps = true;
    

    protected $guarded = array();  

    protected $table = 'clients';
}
