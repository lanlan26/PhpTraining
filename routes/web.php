<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('layouts.app');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//admin pages write below here
Route::group(['middleware' => 'admin'], function(){
	Route::get('admin', function () {
	    return view('admin.master');
	});
	Route::resource('/category','CategoryController',['except' => ['show']]);
    Route::resource('/work', 'WorkController');
	Route::resource('/user','UserController',['except' => ['show']]);
	Route::resource('/contact','ContactController',['only' => ['index', 'show', 'destroy']]);
	Route::resource('/post','PostController',['except' => ['show']]);
});
