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
Route::get('/company','companycontroller@index')->name('company-index');
Route::get('/company-index-data','companycontroller@indexData');
Route::get('/food','foodcontroller@Index');
Route::get('/register','registercontroller@create');
Route::post('/register-store','registercontroller@store');
Route::post('/user','usercontroller@logout');
Route::post('/user-login','usercontroller@loginSubmit');
// Route::get('/display','registercontroller@emailview');

Route::get('/verify/{email}/{verificationCode}','registercontroller@verfiyDone')->name('sendEmailDone');

Route::post('/company-store','companycontroller@store');
Route::get('/company-show/{id}','companycontroller@show');
Route::get('/company-show-data/{id}','companycontroller@showData');
Route::get('/company-show-own','companycontroller@showOwnCompany');
Route::put('/company-profile-image/{companyid}','companyProfileController@update');
Route::put('/company-cover-image/{companyid}','companyCoverController@update');

Route::post('/store-food','foodcontroller@store');
Route::get('/show-company-products/{companyid}','foodcontroller@displaycompanyfood');
Route::get('/fetch-categories','foodcontroller@fetchCategories');

Route::post('/mylist-session/{companyid}','OrderSessionController@store');
Route::get('/mylist-session-show/{companyid}','OrderSessionController@show');
Route::delete('/mylist-session-delete/{companyid}/{foodid}/{size}','OrderSessionController@delete');

Route::get('/category-setting','CategoryController@index');
Route::get('/category-setting-data','CategoryController@indexData');
Route::post('/category-store','CategoryController@store');
Route::delete('/category-delete/{id}','CategoryController@delete');

Route::get('/comp-settings','CompanySettingController@show');
Route::get('/comp-settings-profile','CompanySettingController@showProfile');
Route::get('/comp-settings-cover','CompanySettingController@showCover');
Route::get('/request-proceed/{companyid}','RequestController@show');
