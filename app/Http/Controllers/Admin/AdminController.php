<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Event;

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
        $events = Event::orderBy('id','asc')->paginate(10);
    	return view('admin.events',compact('events'));
    }

    public function admin_pre_events($event_id)
    {
        $event = Event::findOrFail($event_id);
        dd($event->subevents());
    	return view('admin.pre_event',compact('event'));
    }

    public function admin_candidate_criteria($prevent_id)
    {
    	return $prevent_id;
    }
}
