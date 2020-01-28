<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubEvent;

class PreEventController extends Controller
{
    

    public function admin_pre_event_post(Request $request, $event_id)
    {
        $data = $request->except('_token');
        $data['event_id'] = $event_id;
        $data['status_id'] = 1;
    	$sub_event = SubEvent::create($data);

    	return back()->with('success','Pre Event Created Successfully!!');

    }

    public function admin_pre_event_update(Request $request, $event_id, $pre_id)
    {

        $data = $request->except('_token');
        $data['event_id'] = $event_id;
        $data['status_id'] = 1;
        
        $sub_event = SubEvent::whereId($pre_id)->update($data);

    	return back()->with('success','Pre Event Created Successfully!!');


    }
}
