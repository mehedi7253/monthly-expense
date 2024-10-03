<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanEarnController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//middleware routes authentication
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('costs', CostController::class);
    Route::resource('earn-loans', LoanEarnController::class);
});
