<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
<<<<<<< HEAD

=======
use App\Http\Controllers\DeskController;
use App\Http\Controllers\DeskColumnController;
use App\Http\Controllers\TaskController;
>>>>>>> dea7e3a... fix errors templates
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
        Route::get('/{orgId}', [OrganizationController::class, 'show']);
        Route::post('/', [OrganizationController::class, 'store']);
        Route::put('/{orgId}', [OrganizationController::class, 'update']);
        Route::delete('/{orgId}', [OrganizationController::class, 'destroy']);

        // users
        Route::get('/{orgId}/users', [UserController::class, 'index']);
        Route::get('/{orgId}/users/{userId}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{userId}', [UserController::class, 'update']);
        Route::delete('/{orgId}/users/{userId}', [UserController::class, 'destroy']);

        // projects
        Route::get('/{orgId}/projects', [ProjectsController::class, 'index']);
        Route::get('/{orgId}/projects/{projectId}', [ProjectsController::class, 'show']);
        Route::post('/{orgId}/projects', [ProjectsController::class, 'store']);
        Route::put('/{orgId}/projects/{projectId}', [ProjectsController::class, 'update']);
        Route::delete('/{orgId}/projects/{projectId}', [ProjectsController::class, 'destroy']);

<<<<<<< HEAD

    // invite users to organization
    Route::post('/organizations/{orgId}/invite/{roleId}', [InviteController::class, 'inviteToOrganization']);

    // invite users, which exists
    Route::post('/organizations/{orgId}/projects/{projectId}/invite/{proRoleId}',
        [InviteController::class, 'inviteToProjectExitsUser']);

    // invite users, which not exists
//    Route::post('/organizations/{orgId}/invite_project/')
=======
        // invite users to organization
        Route::post('/{orgId}/invite/{roleId}', [InviteController::class, 'inviteToOrganization']);

        // invite users, which exists
        Route::post('/{orgId}/projects/{projectId}/invite/{proRoleId}', [InviteController::class, 'inviteToProjectExitsUser']);

        // desks
        Route::get('/{orgId}/projects/{projectId}/desks/{deskId}', [DeskController::class, 'show']);
        Route::post('/{orgId}/projects/{projectId}/desks', [DeskController::class, 'store']);
        Route::delete('/{orgId}/projects/{projectId}/desks/{deskId}', [DeskController::class, 'destroy']);

        // desks column
        Route::post('/{orgId}/projects/{projectId}/desks/{deskId}/columns', [DeskColumnController::class, 'store']);
        Route::put('/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}', [DeskColumnController::class, 'update']);
        Route::delete('/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}', [DeskColumnController::class, 'destroy']);
    });


    // tasks
    Route::post('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}/tasks', [TaskController::class, 'store']);
    Route::delete('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}/tasks/{taskId}', [TaskController::class, 'destroy']);
    Route::put('/organizations/{orgId}/projects/{projectId}/desks/{deskId}/columns/{columnId}/tasks/{tasksId}', [TaskController::class, 'update']);
>>>>>>> dea7e3a... fix errors templates
});
