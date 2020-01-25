<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    
    public function home()
    {
    	return view('admin.home');
    }

    public function admin_logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function events()
    {
    	return view('admin.events');
    }

    public function admin_pre_events($event_id)
    {
    	return $event_id;
    }

    public function admin_candidate_criteria($prevent_id)
    {
    	return $prevent_id;
    }
}
