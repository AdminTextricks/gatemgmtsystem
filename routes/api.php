<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\OtpCodeController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiMemberController;
use App\Http\Controllers\Api\ApiGuestDetailsController;

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

Route::post('/login', [ApiLoginController::class, 'apiLogin']);
Route::post('/check-device', [ApiMemberController::class, 'checkDevice'])->name('check_device');
Route::post('/check-phone-exist', [ApiMemberController::class, 'checkPhone'])->name('check_phone');
Route::post('/link-device', [ApiUserController::class, 'member_post_action'])->name('link_device');
Route::post('/verify-otp', [OtpCodeController::class, 'verifyMobileByOTP'])->name('verifyOtp');

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get('/vistorslist', [ApiGuestDetailsController::class, 'vistorslist'])->name('guestlist');
    Route::get('/{action}/{id?}', [ApiGuestDetailsController::class, 'guest_action'])->name('guest_action');
    Route::patch('/updatestatus/{id}', [ApiGuestDetailsController::class, 'updatestatus'])->name('update_visitor_status');
    Route::post('/post', [ApiGuestDetailsController::class, 'guest_post_action'])->name('guest.action');
    Route::delete('/delete/{id}', [ApiGuestDetailsController::class, 'delete'])->name('guest.delete');
});
