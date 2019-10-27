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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
| We can combine the the various rouetes e.g Route::get('/threads', 'ThreadController@index') into one
| since they are all using the routes resource(index, create, store, show, update, destroy)
|   Doing this provides a cleaner code.
*/

 Route::get('/threads', 'ThreadsController@index');
 Route::get('/threads/create', 'ThreadsController@create');
 Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
 Route::post('/threads', 'ThreadsController@store');
 Route::get('/threads/{channel}', 'ThreadsController@index');
 Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
