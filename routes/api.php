<?php

use App\Http\Controllers\Arena\ArenaCreateController;
use App\Http\Controllers\Arena\ArenaListAllController;
use App\Http\Controllers\Chat\ChatCreateController;
use App\Http\Controllers\Chat\ChatListController;
use App\Http\Controllers\HealthCheck\StatusController;
use App\Http\Controllers\Message\MessageListController;
use App\Http\Controllers\Message\MessageCreateController;
use App\Http\Controllers\Preference\UserPreferedThemeController;
use App\Http\Controllers\User\UserAuthController;
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

// Message
Route::get('/message', MessageListController::class);
Route::post('/message', MessageCreateController::class);

// Chat
Route::post('/chat', ChatCreateController::class);
Route::get('/chat', ChatListController::class);

// Arena
Route::get('/arenas', ArenaListAllController::class);
Route::post('/arenas', ArenaCreateController::class);

// User
Route::post('/users', UserAuthController::class);
Route::post('/users/admin', UserAuthController::class);

// Update theme preferences
Route::put('/users/theme', UserPreferedThemeController::class);

