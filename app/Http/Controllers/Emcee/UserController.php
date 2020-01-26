<?php

namespace App\Http\Controllers\Emcee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    

    public function emcee_home()
    {
    	return view('emcee.home');
    }

    public function emcee_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }
}
