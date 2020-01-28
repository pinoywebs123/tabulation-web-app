<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use DB;
use App\Candidate;

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
  
    public function admin_ajax_event(Request $request)
    {
    	$event = Event::findOrFail($request->event_id);
        
        if($event->subevents){
            $events = $event->subevents;
        }
    	return response()->json($events);
    }

    public function admin_get_candidate_score(Request $request)
    {
    	$events = Event::all();
    	//return $request;
    	 $groups = DB::table('subevent_criteria_judge')
                ->select('candidate_id')
                ->groupBy('candidate_id')
                ->where('sub_event_id','=', $request->pre_event_id)
                ->get();

       

       foreach ($groups as $key => $value) {
       		$candi = Candidate::findOrFail($value->candidate_id);
       		$value->candidate = $candi->f_name. ' '.$candi->l_name;
       		$value->data = DB::table('subevent_criteria_judge')
       						->join('criterias', 'subevent_criteria_judge.criteria_id', '=', 'criterias.id')
       		 				->where('candidate_id', $value->candidate_id)
       		 				->select('criterias.name', 'criterias.ratio', 'subevent_criteria_judge.score')
       		 				->get();
       				 				
       }

      //dd($groups);

     	return view('admin.home_data',compact('groups','events'));

       //dd($groups);

    }
}
