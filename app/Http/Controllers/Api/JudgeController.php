<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\SubEvent;


class JudgeController extends Controller
{
    

    public function getEvents()
    {
    	$events = Event::orderBy('id','asc')->get();
    	return response()->json($events);
    }

    public function getPreEvents($event_id)
    {
    	$event = Event::findOrFail($event_id);
        
        if($event->subevents){
            $events = $event->subevents;
        }

        return response()->json($events);
    }

    public function candidate_criteria($prevent_id)
    {
    	$preevent = SubEvent::findOrFail($prevent_id);
        if($preevent->criterias){
            $criterias = $preevent->criterias;
        }

        if($preevent->candidate){
            $candidates = $preevent->candidate;
            
        }

        return response()->json(['candidates'=> $candidates,'criterias'=> $criterias]);
    }
}
