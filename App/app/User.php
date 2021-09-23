<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'sex', 'first_name', 'phone_number', 'last_name', 'allergies', 'medical_insurance_provider', 
		'carrier_number', 'plan_number', 'member_id', 'issue_number', 'personal_health_number', 'shots', 'drugs', 'vaccinations', 'user_type', 'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array 
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}

