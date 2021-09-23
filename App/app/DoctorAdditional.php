<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAdditional extends Model
{
	public $timestamps = false;
	protected $table = 'doctor_additional';
    protected $fillable = array('user_id', 'office_name', 'contact_email', 'contact_first_name', 'contact_last_name', 
		'office_street', 'office_city', 'office_province', 'office_postal_code', 'document_name');
 
}

