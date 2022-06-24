<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'state',
        'zipcode',
        'address',
        'details',
        'contact_no',
        'contact_no_verified',
        'contact_no_verification_id',
        'profile_pic',
        'isActive',
        'status'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
