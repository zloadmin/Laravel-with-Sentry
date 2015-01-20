<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Index
Route::get('/', 'HomeController@index' );

//_GET
Route::get('register', 'HomeController@getRegister');
Route::get('login', 'HomeController@getLogin');
Route::get('reset', 'HomeController@getReset');
Route::get('reset/{id}/{code}/', 'HomeController@getResetCode');
Route::get('reset-error', 'HomeController@error');

//_POST
Route::post('register', 'HomeController@postRegister');
Route::post('login', 'HomeController@postLogin');
Route::post('reset', 'HomeController@postReset');
Route::post('reset/{id}/{code}/', 'HomeController@postResetCode');



Route::group(array('before' => 'auth'), function(){
    Route::get('logout', 'HomeController@logout');
    Route::get('profile', 'HomeController@getProfile');
    Route::post('profile', 'HomeController@postProfile');
});