<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/logout', [AuthController::class, 'logoutUser']);

Route::post('/forgot_password', [ResetPasswordController::class, 'getPinCode']);
Route::post('/send_pincode', [ResetPasswordController::class, 'sendPinCode']);
Route::post('/reset_password', [ResetPasswordController::class, 'resetPassword']);
