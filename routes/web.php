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

Route::get('/about', function () {
    return view('welcome');
});
Route::get('/company','companycontroller@index')->name('company-index');
Route::get('/company-index-data','companycontroller@indexData');
Route::get('/','foodcontroller@Index');
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
Route::delete('/mylist-session-delete/{companyid}/{foodid}','OrderSessionController@delete');

Route::get('/category-setting','CategoryController@index');
Route::get('/category-setting-data','CategoryController@indexData');
Route::post('/category-store','CategoryController@store');
Route::delete('/category-delete/{id}','CategoryController@delete');

Route::get('/comp-settings','CompanySettingController@show');
Route::get('/comp-settings-profile','CompanySettingController@showProfile');
Route::get('/comp-settings-cover','CompanySettingController@showCover');
Route::get('/comp-settings-minimum','CompanySettingController@showMinimumVisitor');
Route::get('/comp-settings-colors','CompanySettingController@showColors');
Route::get('/comp-settings-name','CompanySettingController@showName');
Route::get('/comp-settings-description','CompanySettingController@showDescription');

Route::put('/comp-settings-name-update','CompanySettingController@updateName');
Route::put('/comp-settings-description-update','CompanySettingController@updateDescription');
Route::put('/comp-settings-minimum-update','CompanySettingController@updateMinimum');
Route::put('/comp-settings-logo-update','CompanySettingController@updateLogo');
Route::put('/comp-settings-cover-update','CompanySettingController@updateCover');
Route::put('/comp-settings-map-update','CompanySettingController@updateMap');
Route::post('/comp-settings-color','CompanySettingController@addColor');
Route::delete('/comp-settings-color-remove/{id}','CompanySettingController@removeColor');


Route::get('/request-proceed/{companyid}','RequestController@show');
Route::post('/request-proceed-send/{companyid}','RequestController@sendRequest');
Route::get('/show-cater-request','RequestController@showRequestList');
Route::get('/show-cater-request-users','RequestController@fetchRequest');
Route::get('/show-cater-request-data/{orderId}','RequestController@fetchRequestData');

Route::post('/store-drink','DrinkController@store');
Route::get('/show-company-drinks/{companyid}','DrinkController@displayCompanyDrinks');

Route::post('/drink-session/{companyid}','OrderDrinkSessionController@store');
Route::get('/drink-session-show/{companyid}','OrderDrinkSessionController@show');
Route::delete('/drink-session-delete/{companyid}/{drinkid}','OrderDrinkSessionController@delete');

Route::post('/accept-request/{orderid}','RequestController@acceptRequest');
Route::post('/decline-request/{orderid}','RequestController@declineRequest');

Route::get('/calendar-show','ScheduleController@show');
Route::get('/calendar-show-monthly','ScheduleController@showCurrentMonthEvents');
Route::get('/calendar-show-monthly-changed','ScheduleController@showMonthSelectedEvents');

Route::get('/notification','NotificationController@show');
Route::get('/notification-count','NotificationController@countNotif');
