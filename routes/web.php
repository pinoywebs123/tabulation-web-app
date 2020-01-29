<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['prefix'=> 'auth'], function(){
	Route::get('/login', [
		'as' 	=>	'login',
		'uses'	=> 'AuthController@login_view'	
	]);

	Route::post('/login', [
		'as'	=> 'login_check',
		'uses'	=> 'AuthController@login_check'
	]);
});	

Route::group(['prefix'=> 'admin','namespace'=> 'Admin'], function(){
	Route::get('/home', [
		'as'	=> 'admin_home',
		'uses'	=> 'AdminController@home'
	]);

	Route::get('/logout',[
		'as'	=> 'admin_logout',
		'uses'	=> 'AdminController@admin_logout'
	]);

	Route::get('/events', [
		'as'	=> 'admin_events',
		'uses'	=> 'AdminController@events'
	]);

	Route::post('events',[
		'as'	=> 'admin_event_post',
		'uses'	=> 'EventController@admin_event_post'
	]);

	Route::get('/pre-events/{event_id}',[
		'as'	=> 'admin_pre_events',
		'uses'	=> 'AdminController@admin_pre_events'
	]);

	Route::post('/post-event',[
		'as'	=> 'admin_pre_event_post',
		'uses'	=> 'PreEventController@admin_pre_event_post'
	]);

	Route::get('/candidate-with-criteria/{pre_event_id}',[
		'as'	=> 'admin_candidate_criteria',
		'uses'	=> 'AdminController@admin_candidate_criteria'
	]);

	Route::post('/candidate-with-criteria',[
		'as'	=> 'admin_candidate_criteria_post',
		'uses'	=> 'CriteriaController@admin_candidate_criteria_post'
	]);

	Route::post('/create-candidate',[
		'as'	=> 'admin_create_candidate',
		'uses'	=> 'CandidateController@admin_create_candidate'
	]);

	Route::post('/post-event-ajax',[
		'as'	=> 'admin_ajax_event',
		'uses'	=> 'EventController@admin_ajax_event'
	]);

	Route::post('/get-candidate-score-date', [
		'as'	=> 'admin_get_candidate_score',
		'uses'	=> 'EventController@admin_get_candidate_score'
	]);

	Route::get('/candidates',[
		'as'	=> 'admin_get_candidates',
		'uses'	=> 'AdminController@admin_get_candidates'
	]);

	Route::post('/find_candidate',[
		'as'	=> 'admin_find_candidate',
		'uses'	=> 'AdminController@admin_find_candidate'
	]);

	Route::post('/update-candidate', [
		'as'	=> 'admin_update_candidate',
		'uses'	=> 'AdminController@admin_update_candidate'
	]);

	Route::get('/judges-list',[
		'as'	=> 'admin_judges_list',
		'uses'	=> 'AdminController@admin_judges_list'
	]);

	Route::post('/find_judge',[
		'as'	=> 'admin_find_judge',
		'uses'	=> 'AdminController@admin_find_judge'
	]);

	Route::post('/update-judge', [
		'as'	=> 'admin_update_judge',
		'uses'	=> 'AdminController@admin_update_judge'
	]);

	Route::post('/create-judge',[
		'as'	=> 'admin_create_judge',
		'uses'	=> 'AdminController@admin_create_judge'
	]);

	Route::post('/find_criteria',[
		'as'	=> 'admin_find_criteria',
		'uses'	=> 'AdminController@admin_find_criteria'
	]);

	Route::post('/update-criteria', [
		'as'	=> 'admin_update_criteria',
		'uses'	=> 'AdminController@admin_update_criteria'
	]);


});


Route::group(['prefix'=> 'emcee','namespace'=> 'Emcee'], function(){
	Route::get('/home',[
		'as'	=> 'emcee_home',
		'uses'	=> 'UserController@emcee_home'
	]);

	Route::get('/logout',[
		'as'	=> 'emcee_logout',
		'uses'	=> 'UserController@emcee_logout'
	]);

	Route::post('/post-event-ajax',[
		'as'	=> 'emcee_ajax_event',
		'uses'	=> 'UserController@emcee_ajax_event'
	]);

	Route::post('/get-candidate-score-date', [
		'as'	=> 'emcee_get_candidate_score',
		'uses'	=> 'UserController@emcee_get_candidate_score'
	]);

});