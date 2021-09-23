<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
	protected $table = 'pharmacy';
    protected $fillable = array('name', 'phone_number', 'fax_number', 'address', 'zip_code', 'province', 'city');

}
