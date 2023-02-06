<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {

Route::prefix(LaravelLocalization::setLocale())->group(function() {
    // Route::prefix('/{lang}/admin')->name('admin.')->middleware(['check_user', 'auth'])->group(function() {
    Route::prefix('/admin')->name('admin.')->middleware(['check_user', 'auth'])->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class);

    });

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('not-allowed', function() {
    //     return view('not_allowed');
    // });

    Route::view('not-allowed', 'not_allowed');

});


// Route::get('posts/{post}')
