<?php

use App\Http\Controllers\Arenas\ArenasCreateController;
use App\Http\Controllers\Arenas\ArenasListAllController;
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

// Arenas
Route::get('/arenas', ArenasListAllController::class);
Route::post('/arenas', ArenasCreateController::class);

// Users
Route::post('/users', UsersAuthController::class);

// Update theme preferences
Route::put('/users/theme', UsersPreferedThemeController::class);

