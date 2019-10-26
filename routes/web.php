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
| We combine the the various rouetes e.g Route::get('/threads', 'ThreadController@index') into one
| since they are all using the routes resource(index, create, store, show, update, destroy)
|   Doing this provides a cleaner code.
*/
/*
 Route::get('/threads', 'ThreadsController@index')->name('threads');
 Route::post('/threads/create', 'ThreadsController@create');
 Route::post('/threads', 'ThreadsController@store');
 Route::get('/threads/{thread}', 'ThreadsController@show')->name('thread');
 */
Route::resource('threads', 'ThreadsController');
Route::post('/threads/{thread}/replies', 'RepliesController@store');