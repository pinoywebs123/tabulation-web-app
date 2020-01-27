<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\SubEvent;
use App\Candidate;
use Illuminate\Support\Facades\Auth;


class JudgeController extends Controller
{

	public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    

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

    public function candidate_info($candidate_id)
    {
    	$candidate_info =  Candidate::findOrFail($candidate_id);
    	if($candidate_info->subevent){
            $candidates_info_criterias = $candidate_info->subevent;
            
        }


        $preevent = SubEvent::findOrFail($candidates_info_criterias[0]['id']);

        if($preevent->criterias){
            $criterias = $preevent->criterias;
        }


        return response()->json(['criterias'=>$criterias,'candidate_info'=>  $candidate_info]);
    }

    public function candidate_score(Request $request)
    {
    	//return response()->json(['status'=> $request->data]);
    	$datas = json_decode($request->data);
    	
    	foreach ($datas as $key => $morley) {
    		return response()->json(['key'=> $key,'value' => $morley]);
    	}
    	return response()->json(['tae'=> $request]);
    	
    	
    }
}
