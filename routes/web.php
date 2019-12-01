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

        // {domain_name}/auth/* routes
        Route::group(['prefix' => 'auth'], function(){
            Route::get('/profile', [
              'uses'  => 'AuthController@profile',
              'as'  => 'auth.profile',
            ]);
            Route::post('/profile', [
              'uses'  => 'AuthController@profile_update',
              'as'  => 'auth.profile_update',
            ]);
            Route::get('/change_password', [
              'uses'  => 'AuthController@change_password',
              'as'  => 'auth.change_password',
            ]);
            Route::post('/change_password', [
              'uses'  => 'AuthController@change_password_update',
              'as'  => 'auth.change_password_update',
            ]);
        });

        // {domain_name}/users/* routes
        Route::resource('users', 'UserController', [
          'except' => 'show'
        ]);    
        Route::get('/users/datatables/get/data', [
          'uses' => 'UserController@data',
          'as' => 'users.data'
        ]);

        // {domain_name}/division/* routes
        Route::resource('divisions', 'DevisionController');    
        Route::get('/divisions/datatables/get/data', [
          'uses' => 'DevisionController@data',
          'as' => 'divisions.data'
        ]);

        // {domain_name}/skill/* routes
        Route::group(['prefix' => 'skills'], function() {
          Route::get('/datatables/get/data/{service_id}', [
            'uses' => 'SkillController@data',
            'as' => 'skills.data'
          ]);
          Route::get('/show/{service_id}', [
            'uses' => 'SkillController@show',
            'as' => 'skills.show'
          ]);
          Route::post('/store/{service_id}', [
            'uses' => 'SkillController@store',
            'as' => 'skills.store'
          ]);
          Route::get('/edit/{service_id}/{id}', [
            'uses' => 'SkillController@edit',
            'as' => 'skills.edit'
          ]);
          Route::put('/edit/{service_id}/{id}', [
            'uses' => 'SkillController@update',
            'as' => 'skills.update'
          ]);
          Route::delete('/destroy/{service_id}/{id}', [
            'uses' => 'SkillController@destroy',
            'as' => 'skills.destroy'
          ]);
        });

        // Route::resource('skills', 'SkillController', [
        //   'except' => 'show'
        // ]);    
        // Route::get('/skills/datatables/get/data', [
        //   'uses' => 'SkillController@data',
        //   'as' => 'skills.data'
        // ]);

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
