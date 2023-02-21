<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;

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

Route::get('/accept/{token}', [InviteController::class, 'accept']);

Route::post('/forgot_password', [ResetPasswordController::class, 'getPinCode']);
Route::post('/send_pincode', [ResetPasswordController::class, 'sendPinCode']);
Route::post('/reset_password', [ResetPasswordController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // organizations
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::get('/organizations/{org_id}', [OrganizationController::class, 'show']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::put('/organizations/{id}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{id}', [OrganizationController::class, 'destroy']);

    // users
    Route::get('/organizations/{orgId}/users', [UserController::class, 'index']);
    Route::get('/organizations/{orgId}/users/{user_id}', [UserController::class, 'show']);
    Route::post('/organizations/users', [UserController::class, 'store']);
    Route::put('/organizations/users/{id}', [UserController::class, 'update']);
    Route::delete('/organizations/users/{id}', [UserController::class, 'destroy']);

    // projects
    Route::get('/organizations/{orgId}/projects', [ProjectsController::class, 'index']);
    Route::get('/organizations/{orgId}/projects/{project_id}', [ProjectsController::class, 'show']);
    Route::post('/organizations/{orgId}/projects', [ProjectsController::class, 'store']);
    Route::put('/organizations/{orgId}/projects/{id}', [ProjectsController::class, 'update']);
    Route::delete('/organizations/{orgId}/projects/{id}', [ProjectsController::class, 'destroy']);
    // invite users
    Route::post('/organizations/{orgId}/invite_user_role/{roleId}', [InviteController::class, 'store']);
});
