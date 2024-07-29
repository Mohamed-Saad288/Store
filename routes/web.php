<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SocialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


    Route::get('/',[HomeController::class,'index'])
        ->name('home');

    Route::get('/products',[ProductController::class,'index'])
        ->name('products.index');

    Route::get('/products/{product:slug}',[ProductController::class,'show'])
        ->name('products.show');

    Route::get('/checkout',[CheckoutController::class,'create'])
        ->name('checkout');

    Route::post('/checkout',[CheckoutController::class,'store']);

    Route::get('/auth/user/2fa',[TwoFactorAuthenticationController::class,'index'])
        ->middleware('auth')
        ->name('front.2fa');

    Route::post('/currency',[CurrencyConverterController::class,'store'])
        ->name('currency.store');

    Route::resource('cart',CartController::class);

});

Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])
    ->name('auth.socialite.redirect');

Route::get('/auth/{provider}/callback',[SocialLoginController::class,'callback'])
    ->name('auth.socialite.callback');

Route::get('/auth/{provider}/user',[SocialController::class,'index'])
    ->name('auth.social.user');


//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

