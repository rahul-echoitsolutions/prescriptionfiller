<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});


Route::group(['middleware' => 'auth:api'], function () {
//Route::group([], function () {
	
	// pharmacy
	Route::get('/pharmacy/name/{name}/city/{city}', 'PharmacyController@getPharmacies');
	Route::resource('/pharmacy', 'PharmacyController', ['only' => ['show']] );
	
	Route::get('/pharmacy/latitude/{latitude}/longitude/{longitude}', 'PharmacyController@getPharmaciesByLocation');
	Route::resource('/pharmacy', 'PharmacyController', ['only' => ['show']] );

	// prescription
	Route::get('/prescription/user_id/{user_id}', 'PrescriptionController@getPrescriptionsByUserId');

	Route::resource('/user', 'UserController', ['only' => ['index', 'update']] );
	
});

	Route::resource('/prescription', 'PrescriptionController', ['only' => ['store', 'show']]);
	Route::post('/reset_password', 'Auth\ForgotPasswordController@sendResetLinkEmail');


