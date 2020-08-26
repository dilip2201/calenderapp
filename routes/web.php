<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/data/{token}', 'DMSFormController@index');



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () { 

	/***************** Dashboard *************************/
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
	/***************** Profile *************************/
	Route::get('profile', ['as' => 'profile', 'uses' => 'DashboardController@profile']);
	Route::post('profileupdate', ['as' => 'profileupdate', 'uses' => 'DashboardController@profileupdate']);
	Route::post('changepassword', ['as' => 'changepassword', 'uses' => 'DashboardController@changepassword']);
   // Route::group(['middleware' => 'check-permission:super_admin'], function () {
        /******************** User Dev : Vikas 23-08 ***********************/
        Route::resource('users', 'UserController');
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::post('getall', ['as' => 'getall', 'uses' => 'UserController@getall']);
            Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'UserController@getmodal']);
            Route::post('changestatus', ['as' => 'changestatus', 'uses' => 'UserController@changestatus']);
        });
        /******************** User Dev : Vikas 24-08 ***********************/
        Route::resource('dms', 'DMSController');
        Route::get('generateurl', 'GenerateurlController@index');
        Route::post('generateurl/newtoken', ['as' => 'generateurl.newtoken', 'uses' => 'GenerateurlController@newtoken']);

        Route::group(['prefix' => 'dms', 'as' => 'dms.'], function () {
            Route::post('getall', ['as' => 'getall', 'uses' => 'DMSController@getall']);
            Route::post('downloadpdf', ['as' => 'downloadpdf', 'uses' => 'DMSController@downloadpdf']);
            Route::post('importexcel', ['as' => 'importexcel', 'uses' => 'DMSController@importexcel']);
        });
   // });
        
	
});




