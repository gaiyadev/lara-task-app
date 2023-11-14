<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['auth:sanctum']], function () {

// });


Route::prefix('v1/auth')->middleware(['json.response'])->group(function () {
    Route::post('/signup', [AuthController::class, 'signUp'])->name('signup');
    Route::post('/signin', [AuthController::class, 'signIn'])->name('signin');
    Route::put('/verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('/resend-verification-email', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout')->middleware('auth:sanctum');
});

Route::prefix('v1/users')->middleware(['json.response'])->group(function () {
    Route::get('/', [UserController::class, 'fetchAll'])->name('user.all');
    Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('password.email');
    Route::put('/reset-password', [UserController::class, 'resetPassword'])->name('password.reset');
    Route::get('/{id}/user', [UserController::class, 'show'])->name('user.show');
    Route::delete('/{id}/user', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/change-password', [UserController::class, 'changePassword'])->name('user.change_password')->middleware('auth:sanctum');
    Route::post('/profile/create', [UserController::class, 'createProfile'])->name('profile.create')->middleware('auth:sanctum');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth:sanctum');
    Route::get('/profile/show', [UserController::class, 'showProfile'])->name('profile.show')->middleware('auth:sanctum');
});


Route::prefix('v1/roles')->middleware(['json.response'])->group(function () {
    Route::post('/', [RoleController::class, 'store'])->name('role.create');
    Route::get('/', [RoleController::class, 'index'])->name('role.all');
    Route::get('/{id}', [RoleController::class, 'show'])->name('role.show');
    Route::patch('/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});