<?php

use App\Http\Controllers\Arena\ArenaCreateController;
use App\Http\Controllers\Arena\ArenaListAllController;
use App\Http\Controllers\Chat\ChatCreateController;
use App\Http\Controllers\Chat\ChatListController;
use App\Http\Controllers\Chat\ChatTeamCreateController;
use App\Http\Controllers\Friend\FriendCreateController;
use App\Http\Controllers\Friend\FriendListAllController;
use App\Http\Controllers\Friend\FriendUpdateController;
use App\Http\Controllers\HealthCheck\StatusController;
use App\Http\Controllers\Message\MessageListController;
use App\Http\Controllers\Message\MessageCreateController;
use App\Http\Controllers\Preference\UserPreferedThemeController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UsersListAllController;
use App\Http\Controllers\User\UserTeamListAllController;
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

// Team


// Friend
Route::get('/friend', FriendListAllController::class);
Route::post('/friend', FriendCreateController::class);
Route::put('/friend', FriendUpdateController::class);

// Message
Route::get('/message', MessageListController::class);
Route::post('/message', MessageCreateController::class);

// Chat
Route::get('/chat', ChatListController::class);
Route::post('/chat', ChatCreateController::class);
Route::post('/chat/team', ChatTeamCreateController::class);

// Arena
Route::get('/arenas', ArenaListAllController::class);
Route::post('/arenas', ArenaCreateController::class);

// User
Route::get('/users', UsersListAllController::class);
Route::get('/users/team', UserTeamListAllController::class);
Route::post('/users', UserAuthController::class);
Route::post('/users/admin', UserAuthController::class);

// Update theme preferences
Route::put('/users/theme', UserPreferedThemeController::class);

