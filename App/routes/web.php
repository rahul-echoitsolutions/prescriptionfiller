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
//    display nothing
});

//Route::post('/register_pharm', 'PharmacyController@saveRegistrationForm');
//Route::get('/register_pharm', 'PharmacyController@displayRegistrationForm');
//Route::get('/register_complete_pharm', 'PharmacyController@displayCompleteMessage');


//Route::post('/register_doctor', 'DoctorController@saveRegistrationForm');
//Route::get('/register_doctor', 'DoctorController@displayRegistrationForm');
//Route::get('/register_complete_doctor', 'DoctorController@displayCompleteMessage');
Route::resource('/user', 'UserController', ['only' => ['store']] );




//  version 5.4

Auth::routes();
Route::get('/home', function () {
//    display nothing
});


Route::get('/register', function () {
//    display nothing
});



Route::any('/login',function () {
//    display nothing
});


Route::get('/password_reset', function () {
//	return File::get(public_path() . '/reset.html');
});

