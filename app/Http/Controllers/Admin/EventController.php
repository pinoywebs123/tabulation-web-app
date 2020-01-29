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
          $value->pre_event = $request->pre_event_id;
       		$candi = Candidate::findOrFail($value->candidate_id);
       		$value->candidate = $candi->f_name. ' '.$candi->l_name;


          //get more data
       		$value->data = DB::table('subevent_criteria_judge')
       						->join('criterias', 'subevent_criteria_judge.criteria_id', '=', 'criterias.id')
                  ->join('subevents', 'subevent_criteria_judge.sub_event_id', '=', 'subevents.id')
                  ->join('users', 'subevent_criteria_judge.judge_id', '=', 'users.id')
       		 				->where('candidate_id', $value->candidate_id)
       		 				->select('criterias.name', 'criterias.ratio', 'subevent_criteria_judge.score','subevents.id as pre_event_id','users.id as judge_id')
       		 				->get();

               

                 
       				 				
       }

        //discount all judge
       foreach ($groups as $value) {


          $value->total_judge = DB::select( DB::raw("SELECT DISTINCT judge_id FROM subevent_criteria_judge WHERE sub_event_id = '$request->pre_event_id' AND candidate_id = '$value->candidate_id'") );

          $value->total_judge_final = count($value->total_judge);
       }

      

      //dd($groups);

     	return view('admin.home_data',compact('groups','events'));

       //dd($groups);

    }
}
