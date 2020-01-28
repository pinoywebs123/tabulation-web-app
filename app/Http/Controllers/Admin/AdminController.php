<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\SubEvent;
use DB;
use App\Candidate;

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

        $groups = DB::table('subevent_criteria_judge')
                ->select('candidate_id')
                ->groupBy('candidate_id')
                ->where('sub_event_id','=', $prevent_id)
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


    	return view('admin.candidate_criteria',compact('preevent','criterias','candidates','sub_events','groups'));
    }
}
