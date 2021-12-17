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


Route::get('/places/list', 'PlaceController@getPlaces');
Route::get('/places', 'PlaceController@placesPage');
Route::get('/places/view', 'PlaceController@viewPlacePage');
Route::get('/weather', 'PlaceController@getWeather');
Route::get('/place/{fsq_id}','PlaceController@getPlaceDetails');
Route::get('/place/photos/{fsq_id}','PlaceController@getPlacePhoto');