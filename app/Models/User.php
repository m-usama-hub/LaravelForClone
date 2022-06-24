<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Auth;
use Config;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function DonarDetail()
    {
        return $this->hasOne('App\Models\Donar','user_id');
    }

    public function OrganizationDetail()
    {
        return $this->hasOne('App\Models\Company','user_id');
    }



    public function isSuperAdminLoggedIn()
    {
        // return Auth::user()->hasRole('SuperAdmin');
        return Auth::user()->user_type_id == Config('constants.UserTypeIds.SuperAdmin');
    }

    public function isAdminLoggedIn()
    {
        // return Auth::user()->hasRole('Admin');
        return Auth::user()->user_type_id == Config('constants.UserTypeIds.Admin');
    }

    public function isCompanyLoggedIn()
    {
        // return Auth::user()->hasRole('Organization');
        return Auth::user()->user_type_id == Config('constants.UserTypeIds.Company');
    }

    public function isUserLoggedIn()
    {
        // return Auth::user()->hasRole('Donar');
        return Auth::user()->user_type_id == Config('constants.UserTypeIds.User');
    }

    public function GetProfilePic()
    {
        if ($this->isUserLoggedIn()) {

            return $this->DonarDetail->profile_pic != null ? $this->DonarDetail->profile_pic : 'img/default.png';
        }
        if ($this->isCompanyLoggedIn()) {

            return $this->OrganizationDetail->profile_pic != null ? $this->OrganizationDetail->profile_pic : 'img/default.png';
        }
        
        return 'img/default.png';

    }


    public function UserType()
    {
        return $this->belongsTo('App\Models\User_type','user_type_id');
    }


}
