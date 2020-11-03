<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'auth'], function () {

    Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])
        ->name('auth.login');

    Route::get('callback', [\App\Http\Controllers\AuthController::class, 'callback'])
        ->name('auth.callback');

    Route::delete('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('auth.logout');

});
