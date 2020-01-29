<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\SubEvent;
use DB;
use App\Candidate;
use App\User;
use App\Criteria;

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

    public function admin_get_candidates()
    {
        $candidates = Candidate::all();
        return view('admin.candidate_list',compact('candidates'));
    }

    public function admin_find_candidate(Request $request)
    {
        $candidate = Candidate::findOrFail($request->candidate_id);
        return response()->json($candidate);
    }

    public function admin_update_candidate(Request $request)
    {
        $find = Candidate::findOrFail($request->candidate_id);
        $find->update([
            'f_name'    =>$request->f_name,
            'm_name'    =>$request->m_name,
            'l_name'    =>$request->l_name,
            'gender'     =>$request->gender,
            'dob'       =>$request->dob,
            'address'   =>$request->address, 
        ]);

        return back()->with('success','Updated Successfully!');
        
    }

    public function admin_judges_list()
    {
        
        $judges = User::where('role_id',2)->get();
        return view('admin.judges_list',compact('judges'));
    }

    public function admin_find_judge(Request $request)
    {
        $judge = User::findOrFail($request->judge_id);
        return response()->json($judge);
    }

    public function admin_update_judge(Request $request)
    {
        $find = User::findOrFail($request->judge_id);
        $find->update([
            'f_name'    =>$request->f_name,
            'm_name'    =>$request->m_name,
            'l_name'    =>$request->l_name,
            'email'     =>$request->email,
            
        ]);

        return back()->with('success','Updated Successfully!');
        
    }

    public function admin_find_criteria(Request $request)
    {
        $criteria = Criteria::findOrFail($request->criteria_id);
        return response()->json($criteria);
    }

    public function admin_update_criteria(Request $request)
    {
        $find = Criteria::findOrFail($request->criteria_id);
        $find->update([
            'name'    =>$request->name,
            'ratio'    =>$request->ratio
            
        ]);

        return back()->with('success','Updated Successfully!');
        
    }

    public function admin_create_judge(Request $request)
    {
        $data =  $request->except('_token');
        $data['role_id'] = 2;
        $data['password'] = bcrypt('password');
        User::create($data);

        return back()->with('success','Created Successfully!');
    }


}
