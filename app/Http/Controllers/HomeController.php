<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->isUserLoggedIn()){

            dd('In User Login');

            return redirect('/');

        }

        if(Auth::user()->isCompanyLoggedIn()){

            dd('In Company Login');

            // return redirect()->route('user.index');
            return redirect('/');

        }

        if(Auth::user()->isAdminLoggedIn()){

            dd('In Admin Login');

            return redirect()->route('user.index');

        }

        if(Auth::user()->isSuperAdminLoggedIn()){

            return redirect()->route('user.index');

        }
    }

}
