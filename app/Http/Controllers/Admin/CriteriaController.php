<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Criteria;

class CriteriaController extends Controller
{
    
    public function admin_candidate_criteria_post(Request $request)
    {
    	$criteria = Criteria::create($request->except(['_token']));

    	return back()->with('success','Criteria Created Successfully!');

    }
}
