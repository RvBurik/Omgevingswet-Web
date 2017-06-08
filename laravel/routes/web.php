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
//
// Route::get('/', function () {
//     return view('pages.home');
// });

Route::get('/', 'MapController@showMapWithAllCoordinates');

Route::get('/home', 'MapController@showMapWithAllCoordinates');

Route::get('/index', 'MapController@showMapWithAllCoordinates');

Route::get('/index', 'Auth\RegisterController@testCoordinaat');

Route::group(['prefix' => 'project', 'middleware' => 'auth'], function () {
    Route::get('/new', 'MapController@index');

    Route::post('/add', 'ProjectController@save')->name('addProject');

    Route::post('/coordinates', 'MapController@coordinatesSaved');

    Route::get('/delete/{id}', 'ProjectController@delete');

    Route::get('/', 'ProjectController@index');

    Route::get('/{id}', 'ProjectController@view');

    Route::get('/bezwaar/{id}', 'ProjectController@bezwaar');

    Route::post('/bezwaarsend', 'ProjectController@saveBezwaar')->name('objection');

    Route::post('/addInfo', 'ProjectController@addPermitInfo')->name('addPermitInfo');

    Route::get('/{projectId}/file/{infoId}', 'ProjectController@viewInfoFile')->name('viewInfoFile');

    Route::get('/bezwaar/vergunning/{vergunningsid}', 'ProjectController@bezwaarOpVergunning');

    Route::post('/asksubscription', 'ProjectController@askSubscription')->name('subscription');
});
Route::get('/allprojects', 'MapController@showMapWithAllLocationsWithInfo');

Route::get('/permits', 'PermitsController@index');

Auth::routes();

Route::post('register', 'Auth\RegisterController@addUser');

Route::get('/', 'HomeController@index')->name('home');
