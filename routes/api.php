<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OtpCodeController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'apiLogin']);
Route::post('/check-device', [MemberController::class, 'checkDevice'])->name('check_device');
Route::post('/check-phone-exist', [MemberController::class, 'checkPhone'])->name('check_phone');
Route::post('/link-device', [UserController::class, 'member_post_action'])->name('link_device');
Route::post('/verify-otp', [OtpCodeController::class, 'verifyMobileByOTP'])->name('verifyOtp');

Route::group(["middleware"=>"auth:santum"], function(){

});