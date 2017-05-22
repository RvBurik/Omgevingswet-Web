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

Route::group(['prefix' => 'project'/*, 'middleware' => 'auth'*/], function () {
    Route::get('/new', 'MapController@index');

    Route::post('/add', 'ProjectController@save')->name('addProject');

    Route::post('/coordinates', 'MapController@coordinatesSaved');

    Route::get('/delete/{id}', 'ProjectController@delete');

    Route::get('/', 'ProjectController@index');
    
    Route::get('/{id}', 'ProjectController@view');

    Route::post('/addInfo', 'ProjectController@addPermitInfo')->name('addPermitInfo');
});

Route::get('/permits', 'PermitsController@index');

Auth::routes();

Route::post('register', 'Auth\RegisterController@addUser');

Route::get('/', 'HomeController@index')->name('home');
