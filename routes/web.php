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

Route::redirect('/', '/home');

Route::namespace('User')->group(function () {
    Route::get('home', [
        'uses' => 'HomeController@index',
        'as' => 'home',
    ]);
    Route::get('search', [
        'uses' => 'SearchController@search',
        'as' => 'search-document',
    ]);
    Route::get('document/show/{id}', [
        'uses' => 'DocumentController@show',
        'as' => 'view-document',
    ]);
    Route::get('sub-category/{id}', [
        'uses' => 'SearchController@showBySubCategory',
        'as' => 'show-by-sub-category',
    ]);
    Route::get('parent-category/{id}', [
        'uses' => 'SearchController@showBySubCategory',
        'as' => 'show-by-parent-category',
    ]);
    Route::get('document/download/{id}', [
        'uses' => 'DocumentController@download',
        'as' => 'download-document',
    ]);
});

Route::middleware('auth')->namespace('User')->group(function () {
    Route::get('manage-profile', [
        'as' => 'manage-profile',
        'uses' => 'UserController@index',
    ]);
    Route::post('update-profile', [
        'as' => 'update-profile',
        'uses' => 'UserController@update',
    ]);
    Route::resource('document', 'DocumentController')->except([
        'create',
        'show',
    ]);
    Route::get('uploaded-document', [
        'uses' => 'UploadedController@index',
        'as' => 'uploaded-document.index',
    ]);
    Route::get('bookmark-document', [
        'uses' => 'BookmarkController@index',
        'as' => 'bookmark-document.index',
    ]);
    Route::get('delete-bookmark-document/{id}', [
        'uses' => 'BookmarkController@delete',
        'as' => 'bookmark-document.delete',
    ]);
    Route::get('downloaded-document', [
        'uses' => 'DocumentController@showDownloaded',
        'as' => 'downloaded-document.show',
    ]);
});

Route::namespace('Ajax')->group(function () {
    Route::post('get-child-categories', [
        'uses' => 'CategoryController@getChildCategory',
        'as' => 'ajax-get-child-category',
    ]);
    Route::post('upload-image', [
        'uses' => 'UploadImageController@uploadImage',
        'as' => 'ajax-upload-image',
    ]);
    Route::post('live-search', [
        'uses' => 'SearchController@search',
        'as' => 'ajax-live-search',
    ]);
    Route::post('bookmark-document', [
        'uses' => 'DocumentController@bookmark',
        'as' => 'ajax-bookmark-document',
    ]);
    Route::post('cancel-bookmark-document', [
        'uses' => 'DocumentController@cancelBookmark',
        'as' => 'ajax-cancel-bookmark-document',
    ]);
    Route::post('comment-document', [
        'uses' => 'DocumentController@comment',
        'as' => 'ajax-comment-document',
    ]);
});

Route::middleware('auth')->namespace('Admin')->group(function () {
    Route::get('dashboard', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard.index',
    ]);
    Route::resource('manage-users', 'UserController');
    Route::resource('manage-document', 'DocumentController')->except([
        'create',
        'store',
    ]);
    Route::get('published-document', [
        'uses' => 'DocumentController@showPublished',
        'as' => 'manage-document.published',
    ]);
    Route::get('illegal-document', [
        'uses' => 'DocumentController@showIllegal',
        'as' => 'manage-document.illegal',
    ]);
    Route::get('manage-category', [
        'uses' => 'CategoryController@index',
        'as' => 'manage-category.index',
    ]);
    Route::get('manage-moderator', [
        'uses' => 'UserController@showModerator',
        'as' => 'manage-moderator.index',
    ]);
});
