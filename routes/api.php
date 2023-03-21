<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\TaskController;
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
    Route::prefix('/organizations')->group(function () {
        // organizations
        Route::get('/',[OrganizationController::class, 'index']);
        Route::get('/{org}', [OrganizationController::class, 'show']);
        Route::post('/', [OrganizationController::class, 'store']);
        Route::put('/{org}', [OrganizationController::class, 'update']);
        Route::delete('/{org}', [OrganizationController::class, 'destroy']);

        // users
        Route::get('/{org}/users', [UserController::class, 'index']);
        Route::get('/{org}/users/{user}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/{org}/users/{user}', [UserController::class, 'destroy']);

        // projects
        Route::get('/{org}/projects', [ProjectsController::class, 'index']);
        Route::get('/{org}/projects/{project}', [ProjectsController::class, 'show']);
        Route::post('/{org}/projects', [ProjectsController::class, 'store']);
        Route::put('/{org}/projects/{project}', [ProjectsController::class, 'update']);
        Route::delete('/{org}/projects/{project}', [ProjectsController::class, 'destroy']);

        // invite users to organization
        Route::post('/{org}/invite/{roleId}', [InviteController::class, 'inviteToOrganization']);

        // invite users, which exists
        Route::post('/{org}/projects/{project}/invite/{proRoleId}', [InviteController::class, 'inviteToProjectExistUser']);

        // desks
        Route::get('/{org}/projects/{project}/desks/{desk}', [DeskController::class, 'show']);
        Route::post('/{org}/projects/{project}/desks', [DeskController::class, 'store']);
        Route::delete('/{org}/projects/{project}/desks/{desk}', [DeskController::class, 'destroy']);

        // desks column
        Route::post('/{org}/projects/{project}/desks/{desk}/columns', [DeskColumnController::class, 'store']);
        Route::put('/{org}/projects/{project}/desks/{desk}/columns/{column}', [DeskColumnController::class, 'update']);
        Route::delete('/{org}/projects/{project}/desks/{desk}/columns/{column}', [DeskColumnController::class, 'destroy']);

        // tasks
        Route::post('/{org}/projects/{project}/desks/{desk}/columns/{column}/tasks', [TaskController::class, 'store']);
        Route::delete('/{org}/projects/{project}/desks/{desk}/columns/{column}/tasks/{task}', [TaskController::class, 'destroy']);
        Route::put('/{org}/projects/{project}/desks/{desk}/columns/{column}/tasks/{task}', [TaskController::class, 'update']);
    });
});
