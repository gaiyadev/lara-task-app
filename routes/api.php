<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureJsonResponse;

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
    Route::post('/signin', [AuthController::class, 'signIn']) -> name('signin');
    Route::put('/verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('/resend-verification-email', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
    Route::post('/logout', [AuthController::class, 'logOut']) -> name('logout')->middleware('auth:sanctum');
});