<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    
    public function login_view()
    {
    	return view('login');
    }

    public function login_check(Request $request)
    {

    	if(Auth::attempt($request->except('_token')))
    	{
            if(Auth::user()->role_id == 1){
                return  redirect()->route('admin_home');
            }else if(Auth::user()->role_id == 3){
                return  redirect()->route('emcee_home');
            }
    		
    	}else
    	{
    		return  'invalid';
    	}
    }
}
