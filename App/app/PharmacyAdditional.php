<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyAdditional extends Model
{
	public $timestamps = false;
	protected $table = 'pharmacy_additional';
    protected $fillable = array('user_id', 'pharmacy_name', 'pharmacy_store_number', 'contact_email', 'contact_first_name', 
		'contact_last_name', 'document_name', 'city');
 
}

