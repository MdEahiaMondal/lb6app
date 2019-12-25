<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::view('/', 'welcome');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin',
    'middleware' => ['auth', 'can:isAllowed, "Admin:Publisher:Subscriber"', ]],
    function (){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::post('/tinymce/upload', 'CategoryController@tinyMceUpload');
    Route::resource('countries', 'CountryController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

});


Auth::routes();

Route::match(['get', 'post'], '/home', 'HomeController@index')->name('home');


