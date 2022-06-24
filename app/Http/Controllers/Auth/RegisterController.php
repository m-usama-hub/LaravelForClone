<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Donar;
use App\Models\Company;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Config;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type_id' => ['required'],
            // 'role' => 'in:'.implode(',',Role::get()->pluck('name')->toArray()),            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type_id' => $data['user_type_id'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($user->UserType->getRoleNames());

        // if($user->hasRole('Organization')){

        //     Company::create([
        //         'user_id'=>$user->id,
        //         "contact_no"=>$data['number'] ?? '',
        //         "isActive"=>1,
        //     ]);

        // }

        // if($user->hasRole('Donar')){

        //     Donar::create([
        //         'user_id'=>$user->id,
        //         "contact_no"=>$data['number'] ?? '',
        //         "isActive"=>1,
        //     ]);

        // }

        return $user;
    }
}
