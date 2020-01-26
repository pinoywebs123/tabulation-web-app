<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Candidate;

class CandidateController extends Controller
{
    

    public function admin_create_candidate(Request $request)
    {
    	
    	$candidate = Candidate::create($request->except(['pre_event_id','_token']));
    	
    	$candidate->subevent()->attach($request->pre_event_id);
    	return back()->with('success','Candidate Created Successfully!');
    }
}
