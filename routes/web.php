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
Route::get('/','ProductController@Index');
Route::get('/register','registercontroller@create');
Route::post('/register-store','registercontroller@store');
Route::post('/user','usercontroller@logout');
Route::post('/user-login','usercontroller@loginSubmit');
Route::get('/my-account-settings','usercontroller@settingsShow');
// Route::get('/display','registercontroller@emailview');

Route::get('/verify/{email}/{verificationCode}','registercontroller@verfiyDone')->name('sendEmailDone');

Route::post('/company-store','companycontroller@store');
Route::get('/company-show/{id}','companycontroller@show');
Route::get('/company-show-data/{id}','companycontroller@showData');
Route::get('/company-show-own','companycontroller@showOwnCompany');
Route::put('/company-profile-image/{companyid}','companyProfileController@update');
Route::put('/company-cover-image/{companyid}','companyCoverController@update');

Route::post('/store-product','ProductController@store');
Route::put('/update-product/{productId}','ProductController@update');
Route::get('/show-company-products/{companyid}','ProductController@displaycompanyproduct');
Route::delete('/delete-product/{productId}','ProductController@delete');
Route::get('/fetch-edit-detail/{productId}','ProductController@fetchEditDetail');
Route::put('/toggle-availability/{productId}','ProductController@toggleAvailable');

Route::post('/mylist-session/{companyid}','OrderSessionController@store');
Route::get('/mylist-session-show/{companyid}','OrderSessionController@show');
Route::delete('/mylist-session-delete/{companyid}/{foodid}','OrderSessionController@delete');

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

Route::post('/accept-request/{orderid}','RequestController@acceptRequest');
Route::post('/decline-request/{orderid}','RequestController@declineRequest');

Route::get('/calendar-show','ScheduleController@show');
Route::get('/calendar-show-monthly','ScheduleController@showCurrentMonthEvents');
Route::get('/calendar-show-monthly-changed','ScheduleController@showMonthSelectedEvents');

Route::get('/notification','NotificationController@show');
Route::get('/notification-count','NotificationController@countNotif');

Route::get('/package-create','PackageController@create');
Route::post('/package-store','PackageController@store');
Route::post('/package-proceed','PackageController@proceed');
Route::get('/package-show/{packageid}','PackageController@show');
Route::get('/package-show-data-name/{packageid}','PackageController@showName');
Route::get('/package-show-data-description/{packageid}','PackageController@showDescription');
Route::get('/package-all-product','PackageController@showallproduct');
Route::get('/package-all/{companyid}','PackageController@showAllPackageOnProfile');
Route::get('/package-show-data-price/{packageId}','PackageController@showPrice');
Route::get('/package-show-data-products/{packageId}','PackageController@showPackageProducts');

Route::put('/package-update-name/{packageId}','PackageController@updateName');
Route::put('/package-update-desc/{packageId}','PackageController@updateDescription');
Route::put('/package-update-price/{packageId}','PackageController@updatePrice');

Route::delete('/remove-package-product/{packageId}/{productId}','PackageController@removePackageProduct');
Route::post('/add-package-product/{packageId}','PackageController@storePackageProduct');
Route::delete('/package-delete/{packageId}','PackageController@delete');
