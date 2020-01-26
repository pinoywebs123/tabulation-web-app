<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubEvent;

class PreEventController extends Controller
{
    

    public function admin_pre_event_post(Request $request)
    {

    	$sub_event = SubEvent::create($request->except(['_token','event_id']));
    	$sub_event->event()->attach($request->event_id,['status_id'=> 1]);

    	return back()->with('success','Pre Event Created Successfully!!');


    }
}
