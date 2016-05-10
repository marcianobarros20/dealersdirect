<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    //
    public $timestamps = true;
	protected $table = 'contact_list';
	protected $guarded = array();
}
