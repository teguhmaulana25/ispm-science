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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

/**
 * 
 * Admin SIDE
 * 
 */
Route::group(['namespace' => 'Admin', 'domain' => env('APP_ADMIN_URL')], function() {
    Auth::routes();
    Route::get('/', 'Auth\LoginController@showLoginForm');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/dashboard', [
          'uses' => 'DashboardController@index',
          'as' => 'dashboard'
        ]);
    });
});



/**
 * 
 * Customer SIDE
 * 
 */
Route::group(['namespace' => 'Customer', 'domain' => env('APP_URL')], function () {
    Route::get('/', [
        'uses' => 'PagesController@index',
        'as' => 'home_pages'
    ]);
});
