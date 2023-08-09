<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \Auth\LoginController;
use \Auth\RegisterController;
use \Auth\ForgotPasswordController;
use \Auth\ResetPasswordController;
use \Auth\VerificationController;
use \App\Http\Controllers\Admin\HomeController;
use \App\Http\Controllers\Admin\SettingsController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\ServiceController;
use \App\Http\Controllers\Admin\CouponController;
use \App\Http\Controllers\Admin\OrderController;
use \App\Http\Controllers\Admin\ReviewController;
use \App\Http\Controllers\Admin\SubscriptionController;
use \App\Http\Controllers\Admin\TestimonialController;
use \App\Http\Controllers\Admin\NewsletterController;
use \App\Http\Controllers\Admin\ContactController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('admin')->group(function () {

    Route::middleware(['guest'])->group(function () {
        // guest

    });

    Route::group(['middleware' => ['auth:admin'], 'as' => 'Admin::'], function() { // For Admin::

        Route::get('/', [HomeController::class, 'index']);
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::resource('subscriptions', SubscriptionController::class)->except('create', 'store');
        Route::resource('testimonials', TestimonialController::class);
    });
});
