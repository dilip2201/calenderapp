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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () { 

	/***************** Dashboard *************************/
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
	/***************** Profile *************************/
	Route::get('profile', ['as' => 'profile', 'uses' => 'DashboardController@profile']);
	Route::post('profileupdate', ['as' => 'profileupdate', 'uses' => 'DashboardController@profileupdate']);
	Route::post('changepassword', ['as' => 'changepassword', 'uses' => 'DashboardController@changepassword']);
	
});




