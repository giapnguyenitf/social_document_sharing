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
Auth::routes();

Route::namespace('Auth')->group(function (){
    Route::get('redirect/{provider}', [
        'as' => 'redirect',
        'uses' => 'SocialLoginController@redirectToProvider',
    ]);
    Route::get('callback/{provider}', [
        'as' => 'callback',
        'uses' => 'SocialLoginController@handleProviderCallback',
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'LoginController@logout',
    ]);
});

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

Route::middleware('auth')->group(function () {
    Route::namespace('User')->group(function () {
        Route::get('manage-profile', [
            'as' => 'manage-profile',
            'uses' => 'UserController@index',
        ]);
        Route::post('update-profile', [
            'as' => 'update-profile',
            'uses' => 'UserController@update',
        ]);
        Route::resource('document', 'DocumentController');
    });
});
