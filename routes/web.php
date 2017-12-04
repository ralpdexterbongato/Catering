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
Route::get('/company','companycontroller@Index');
Route::get('/food','foodcontroller@Index');
Route::get('/register','registercontroller@create');
Route::post('/register','registercontroller@store');
Route::post('/user','usercontroller@logout');
Route::post('/user-login','usercontroller@loginSubmit');
