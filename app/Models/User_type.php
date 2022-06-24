<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User_type extends Model
{

	use HasRoles;

	public $table = "user_types";
	
	protected $guard_name = 'web';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_name',
        'slug',
    ];

	// public function Roles(){
    //   return $this->belongsTo('App\Models\User','user_id');
    // }
}
