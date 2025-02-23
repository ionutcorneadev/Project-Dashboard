<?php

use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\CustomRegistrationController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


Route::middleware(['auth'])->prefix('admin')->group(function(){

    Route::get('/', function() {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
});

Auth::routes();

Route::controller(HomeController::class)->group(function() {

    Route::get('/', 'index')->name('home');
    Route::get('/post/{post:slug}', 'post')->name('home.post');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/contact', 'contact')->name('home.contact');
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(CustomLoginController::class)->group(function(){

    // Route::get('/custom-login', 'customShowLoginForm')->name('custom.login');
    Route::view('/custom-login', 'custom-login')->name('custom.login')->middleware('guest');
    Route::post('/custom-logout', 'customLogout')->name('custom.logout');
    Route::post('/custom-login', 'customLogin')->name('custom.login.post');
    Route::get('/custom-show-link-form/', 'customShowLinkForm')->name('custom.link.request');
    Route::post('/custom-reset', 'customReset')->name('custom.reset');
    Route::get('/custom-password/reset/{token}', 'customShowResetForm')->name('custom.show.reset');
    Route::post('/custom-password/reset/', 'customPasswordUpdate')->name('custom.update');
});


Route::controller(CustomRegistrationController::class)->group(function(){

    Route::view('/custom-register', 'custom-register')->name('custom.show.register')->middleware('guest');
    Route::post('/custom-register', 'customRegister')->name('custom.register');

});
