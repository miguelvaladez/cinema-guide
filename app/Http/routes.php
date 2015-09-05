<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});


Route::group(['prefix' => 'api/v1'], function() {

	Route::resource('cinemas', 'CinemaController', ['except' => ['create','edit']]);
	Route::resource('movies', 'MovieController', ['except' => ['create','edit']]);
	Route::resource('sessions', 'SessionTimeController', ['only' =>  ['index', 'store']]);
	Route::get('movies/{id}/sessions', ['as' => 'api.v1.movies.sessions', 'uses' => 'MovieController@sessions']);
	Route::get('cinemas/{id}/sessions', ['as' => 'api.v1.cinemas.sessions', 'uses' => 'CinemaController@sessions']);
	Route::get('sessions/search', ['as' => 'api.v1.sessions.search', 'uses' => 'SessionTimeController@search']);

});
