<?php

Route::group(['middleware' => 'auth'], function(){

	Route::resource('quotes','QuoteController', ['except' => ['index', 'show']]);
	Route::post('/comment/{id}', 'CommentController@store');
	Route::put('/comment/{id}', 'CommentController@update');
	Route::get('/comment/{id}/edit', 'CommentController@edit');
	Route::delete('/comment/{id}', 'CommentController@destroy');
	Route::get('/like/{type}/{model}', 'LikeController@like');


});

Route::get('/', function () { return view('welcome');});
Auth::routes();

Route::get('/profile/{id?}', 'HomeController@profile');
Route::get('quotes/random', 'QuoteController@random');
Route::get('quotes/filter/{tag}', 'QuoteController@filter');
Route::resource('quotes','QuoteController', ['only' => ['index', 'show' ]]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');
Route::get('/home', 'HomeController@index')->name('home');
