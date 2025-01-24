<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/', function () {
    return redirect('/listing');
});
Route::get('/hello', [\App\Http\Controllers\IndexController::class, 'show']);

Route::resource('listing', \App\Http\Controllers\ListingController::class)->only(['index', 'show']);

Route::resource('listing.offer', \App\Http\Controllers\ListingOfferController::class)
    ->only(['store'])
    ->middleware('auth');


Route::get('login', [\App\Http\Controllers\AuthController::class, 'create'])->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', \App\Http\Controllers\UserAccountController::class )
    ->only(['create', 'store']);

Route::resource('notification', \App\Http\Controllers\NotificationController::class)
    ->middleware('auth')
    ->only(['index']);

Route::put('notification/{notification}/seen', \App\Http\Controllers\NotificationAcceptController::class)->middleware('auth')->name('notification.seen');

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function () {
       Route::name('listing.restore')->put('listing/{listing}/restore', [\App\Http\Controllers\RealtorListingController::class, 'restore'])->withTrashed();
       Route::resource('listing.image', \App\Http\Controllers\RealtorListingImageController::class)->only(['create', 'store', 'destroy']);
       Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)->withTrashed();

       Route::name('offer.accept')->put('/offer/{offer}/accept', \App\Http\Controllers\RealtorOfferAcceptController::class);
    });
