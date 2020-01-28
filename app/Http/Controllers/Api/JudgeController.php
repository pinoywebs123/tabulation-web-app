<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\SubEvent;
use App\Candidate;
use Illuminate\Support\Facades\Auth;
use DB;
use JWTAuth;

class JudgeController extends Controller
{
	

	public function login(Request $request)
    {
    	//return response()->json($request);
    	

        if (! $token = auth('api')->attempt(['email'=> $request->email,'password'=> $request->password])) {
            return response()->json(['error' => 'Unauthorized','status'=> 401], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
    	// $user = JWTAuth::parseToken()->authenticate();
    	// return response()->json($user);

        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out','status'=> 200]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'status'=> 200
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

    	$user = JWTAuth::parseToken()->authenticate();
    	
    	//return response()->json($request);
    	DB::table('subevent_criteria_judge')->insert([
    		'sub_event_id'	=> $request->sub_event_id,
    		'criteria_id'	=> $request->criteria_id,
    		'judge_id'		=> $user->id,
    		'score'			=> $request->score,
            'candidate_id'  => $request->candidate_id
    	]);
    	return response()->json(['status'=> 200,'message'=> 'Score Successfully Saved!']);
    	//return response()->json(['tae'=> $request]);
    	
    	
    }
}
