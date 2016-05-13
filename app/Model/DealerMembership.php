<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DealerMembership extends Model
{

    public $timestamps = true;
	protected $table = 'dealers_membership_info';
	protected $guarded = array();
}
