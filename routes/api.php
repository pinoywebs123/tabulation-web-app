<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/morley',function(){
	return response()->json(['status'=> 'Connected to Server']);
});


Route::group(['namespace'=> 'Api','middleware'=> 'cors'], function(){

	Route::get('/login','JudgeController@login');

	Route::get('/getEvents','JudgeController@getEvents');

	Route::get('/getPreEvents/{id}','JudgeController@getPreEvents');

	Route::get('/candidate_criteria/{id}','JudgeController@candidate_criteria');

	Route::get('/candidate_info/{candidate_id}','JudgeController@candidate_info');

	Route::post('/candidate_score','JudgeController@candidate_score');

	
});
