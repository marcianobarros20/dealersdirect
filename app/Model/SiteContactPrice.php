<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteContactPrice extends Model
{

    public $timestamps = true;
	protected $table = 'site_contact_price';
	protected $guarded = array();
	protected $fillable=['added_by','price'];
}
