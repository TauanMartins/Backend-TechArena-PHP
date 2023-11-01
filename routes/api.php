<?php

use App\Http\Controllers\HealthCheck\StatusController;
use App\Http\Controllers\Preferences\UsersPreferedThemeController;
use App\Http\Controllers\Users\UsersAuthController;
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

Route::get('/health-check', StatusController::class);

Route::post('/users', UsersAuthController::class);
Route::put('/users/theme', UsersPreferedThemeController::class);