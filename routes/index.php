<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'auth'], function(){
	Route::get('/', 'HomeController@index');
	Route::get('/test', 'HomeController@test');
});