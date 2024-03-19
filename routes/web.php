<?php

use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('verification');
});

/*Route::get('/sends', [SmsController::class, 'sends']);
*/

Route::get('/verify', 'App\Http\Controllers\VerificationController@showVerificationForm')->name('verification.form');
Route::post('/send-verification-code', 'App\Http\Controllers\VerificationController@sendVerificationCode')->name('send-verification-code');
Route::post('/verify-code', 'App\Http\Controllers\VerificationController@verifyCode')->name('verify-code');
