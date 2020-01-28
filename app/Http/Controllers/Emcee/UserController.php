<?php

namespace App\Http\Controllers\Emcee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Event;
use DB;
use App\Candidate;

class UserController extends Controller
{
    

    public function emcee_home()
    {
    	$events = Event::all();
    	return view('emcee.home',compact('events'));
    }

    public function emcee_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function emcee_ajax_event(Request $request)
    {
    	$event = Event::findOrFail($request->event_id);
        
        if($event->subevents){
            $events = $event->subevents;
        }
    	return response()->json($events);
    }

    public function emcee_get_candidate_score(Request $request)
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

     	return view('emcee.home_data',compact('groups','events'));

       //dd($groups);

    }

}
