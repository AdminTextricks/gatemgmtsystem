<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/check-device', [MemberController::class, 'checkDevice'])->name('check_device');
Route::get('/check-phone-exist', [MemberController::class, 'checkPhone'])->name('check_phone');
Route::get('/link-device', [UserController::class, 'member_post_action'])->name('link_device');
