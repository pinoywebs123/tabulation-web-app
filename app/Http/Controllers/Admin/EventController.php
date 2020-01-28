<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    
    public function admin_event_post(Request $request)
    {
    	$data = $request->except('_token');
    	$data['status_id'] = 1;
    	Event::create($data);
    	return back()->with('success','Event Created Successfully!');
    }

    public function admin_event_update(Request $request, $event_id)
    {
        $data = $request->except('_token', 'id');
        $data['id'] = $event_id;
    	$data['status_id'] = 1;
    	Event::whereId($event_id)->update($data);
    	return back()->with('success','Event Updated Successfully!');
    }
}
