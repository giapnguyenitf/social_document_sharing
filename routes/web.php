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
    return view('user.pages.home');
})->name('home');

Route::get('/home/master-layouts', function () {
    return view('user.layouts.master');
});

Route::prefix('dashboard')->group(function () {
    Route::get('new-document', function () {
        return view('admin.pages.newDocument');
    })->name('dashboard.page.newDocument');

    Route::get('public-document', function() {
        return view('admin.pages.publicDocument');
    })->name('dashboard.page.publicDocument');

    Route::get('illegal-document', function() {
        return view('admin.pages.illegalDocument');
    })->name('dashboard.page.illegalDocument');

    Route::get('list-user', function () {
        return view('admin.pages.listUser');
    })->name('dashboard.page.listUser');

    Route::get('list-category', function () {
        return view('admin.pages.listCategory');
    });

    Route::get('add-new-user', function () {
        return view('admin.pages.addNewUser');
    });

    Route::get('edit-info-user', function () {
        return view('admin.pages.editInfoUser');
    });

    Route::get('edit-info-document', function () {
        return view('admin.pages.editInfoDocument');
    });

    Route::get('list-partner', function () {
        return view('admin.pages.listPartner');
    });
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
