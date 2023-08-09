<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::middleware(['defaultLanguage'])->group(function () {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/about', [IndexController::class, 'about']);

    Auth::routes([
    //    'register' => false
        'verify' => true,
    //    'resend' => true,
    ]);

});

Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleCallback'])->name('auth.socialite.callback');


Route::prefix('home')->group(function () {
    Route::group(['middleware' => ['auth:web', 'isActive', 'verified'], 'as' => 'User::'], function() { // For User::

        Route::get('/', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
        Route::get('/settings', [\App\Http\Controllers\User\SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\User\SettingsController::class, 'update'])->name('settings.update');

        Route::get('/order-history', [\App\Http\Controllers\User\OrderHistoryController::class, 'index'])->name('orderHistory.index');
        Route::post('/order-history/write-review', [\App\Http\Controllers\User\OrderHistoryController::class, 'store_write_review'])->name('store_write_review');

    });
});
