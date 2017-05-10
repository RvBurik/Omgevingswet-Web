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
    return view('pages.home');
});

Route::get('/home', function(){
    return view('pages.home');
});

Route::get('/index', function(){
    return view('pages.home');
});

Route::group(['prefix' => 'project', 'middleware' => 'auth'], function () {
    Route::get('/new', 'MapController@index');

    Route::get('/add', 'ProjectController@save')->name('addProject');

    Route::get('/delete/{id}', 'ProjectController@delete');

    Route::get('/', 'ProjectController@index');
});

Auth::routes();
