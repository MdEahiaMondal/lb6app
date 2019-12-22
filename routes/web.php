<?php

use Illuminate\Http\Request;

Route::get('/', function ($name = 'khan') {
    return view('welcome', compact('name'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lal/{id}', 'HomeController@lal')->name('lal');



Route::resource('posts', 'PostController');

Route::resource('users', 'UserProfileController');


