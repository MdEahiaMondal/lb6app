<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function ($name = 'khan') {
    return view('welcome', compact('name'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::post('/tinymce/upload', 'CategoryController@tinyMceUpload');
    Route::resource('countries', 'CountryController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

});


