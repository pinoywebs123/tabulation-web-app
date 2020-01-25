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
});