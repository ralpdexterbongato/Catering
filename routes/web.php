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
Route::get('/company','companycontroller@index');
Route::get('/food','foodcontroller@Index');
Route::get('/register','registercontroller@create');
Route::post('/register-store','registercontroller@store');
Route::post('/user','usercontroller@logout');
Route::post('/user-login','usercontroller@loginSubmit');
// Route::get('/display','registercontroller@emailview');

Route::get('/verify/{email}/{verificationCode}','registercontroller@verfiyDone')->name('sendEmailDone');

Route::post('/company-store','companycontroller@store');
Route::get('/company-show/{id}','companycontroller@show');
Route::get('/company-show-own','companycontroller@showOwnCompany');
