<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\DeskColumnController;
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

Route::get('/accept/{token}', [InviteController::class, 'acceptInviteToOrganization']);

Route::post('/forgot_password', [ResetPasswordController::class, 'getPinCode']);
Route::post('/send_pincode', [ResetPasswordController::class, 'sendPinCode']);
Route::post('/reset_password', [ResetPasswordController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // organizations
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::get('/organizations/{orgId}', [OrganizationController::class, 'show']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::put('/organizations/{orgId}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{orgId}', [OrganizationController::class, 'destroy']);

    // users
    Route::get('/organizations/{orgId}/users', [UserController::class, 'index']);
    Route::get('/organizations/{orgId}/users/{userId}', [UserController::class, 'show']);
    Route::post('/organizations/users', [UserController::class, 'store']);
    Route::put('/organizations/users/{userId}', [UserController::class, 'update']);
    Route::delete('/organizations/{orgId}/users/{userId}', [UserController::class, 'destroy']);

    // projects
    Route::get('/organizations/{orgId}/projects', [ProjectsController::class, 'index']);
    Route::get('/organizations/{orgId}/projects/{projectId}', [ProjectsController::class, 'show']);
    Route::post('/organizations/{orgId}/projects', [ProjectsController::class, 'store']);
    Route::put('/organizations/{orgId}/projects/{projectId}', [ProjectsController::class, 'update']);
    Route::delete('/organizations/{orgId}/projects/{projectId}', [ProjectsController::class, 'destroy']);

    // invite users to organization
    Route::post('/organizations/{orgId}/invite/{roleId}', [InviteController::class, 'inviteToOrganization']);

    // invite users, which exists
    Route::post('/organizations/{orgId}/projects/{projectId}/invite/{proRoleId}', [InviteController::class, 'inviteToProjectExitsUser']);

    // desks
    Route::get('/organizations/{orgId}/projects/{projectId}/desks/{deskId}', [DeskController::class, 'show']);
    Route::post('/organizations/{orgId}/projects/{projectId}/desks', [DeskController::class, 'store']);
    Route::delete('/organizations/{orgId}/projects/{projectId}/desks/{deskId}', [DeskController::class, 'destroy']);

    // desks column
    Route::post('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns', [DeskColumnController::class, 'store']);
    Route::put('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}', [DeskColumnController::class, 'update']);
    Route::delete('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}', [DeskColumnController::class, 'destroy']);
});
