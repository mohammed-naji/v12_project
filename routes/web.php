<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\SiteController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {

Route::prefix(LaravelLocalization::setLocale())->group(function() {
    // Route::prefix('/{lang}/admin')->name('admin.')->middleware(['check_user', 'auth'])->group(function() {
    Route::prefix('/admin')->name('admin.')->middleware(['check_user', 'auth'])->group(function() {

        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/freelancers', [AdminController::class, 'freelancers'])->name('freelancers');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings-data', [AdminController::class, 'settings_data'])->name('settings_data');
        Route::delete('/freelancers/{id}', [AdminController::class, 'freelancers_destroy'])->name('freelancers.destroy');
        Route::resource('categories', CategoryController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('projects', ProjectController::class);

    });

    Route::get('/', [SiteController::class, 'index'])->name('site.index');

    Route::get('/category/{category:slug}', [SiteController::class, 'category'])->name('site.category');

    Route::get('/project/{project:slug}', [SiteController::class, 'project'])->name('site.project');

    Route::get('/project/{project:slug}/apply-now', [SiteController::class, 'apply_now'])->name('site.apply_now');

    Route::post('/project/{project:slug}/apply-now', [SiteController::class, 'apply_now_data'])->name('site.apply_now_data');

    Route::get('/delete-proposal/{id}', [SiteController::class, 'delete_proposal'])->name('site.delete_proposal');

    Route::get('/user/profile', [SiteController::class, 'user_profile'])->name('site.user_profile')->middleware('auth');
    Route::post('/notify/{id}', [SiteController::class, 'read_notify'])->name('site.read_notify')->middleware('auth');


    // Route::get('/category/{slug}', [SiteController::class, 'category'])->name('site.category');

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('not-allowed', function() {
    //     return view('not_allowed');
    // });

    Route::view('not-allowed', 'not_allowed');

});


// Route::get('posts/{post}')
