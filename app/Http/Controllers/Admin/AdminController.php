<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\SubEvent;


class AdminController extends Controller
{
    
    public function home()
    {
        $events = Event::all();
    	return view('admin.home',compact('events'));
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
        
        if($event->subevents){
            $events = $event->subevents;
        }

    	return view('admin.pre_event',compact('event','events'));
    }

    public function admin_candidate_criteria($prevent_id)
    {
        $preevent = SubEvent::findOrFail($prevent_id);
        if($preevent->criterias){
            $criterias = $preevent->criterias;
        }

        if($preevent->candidate){
            $candidates = $preevent->candidate;
            
        }
        foreach($preevent->event as $aw){
           $event_id = $aw->id;
        }

        $event = Event::findOrFail($event_id);
       
        $sub_events = $event->subevents;


    	return view('admin.candidate_criteria',compact('preevent','criterias','candidates','sub_events'));
    }
}
