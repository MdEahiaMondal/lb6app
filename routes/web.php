<?php

use Illuminate\Http\Request;

Route::get('/', function ($name = 'khan') {
    return view('welcome', compact('name'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('countries', 'CountryController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

});
