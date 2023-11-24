<?php

use App\Http\Controllers\Appointments\AppointmentsCreateController;
use App\Http\Controllers\Appointments\AppointmentsListAllController;
use App\Http\Controllers\SportMaterial\SportMaterialListAllController;
use App\Http\Controllers\User\UserAppointmentRequestController;
use App\Http\Controllers\Arena\ArenaCreateController;
use App\Http\Controllers\Arena\ArenaEditController;
use App\Http\Controllers\Arena\ArenaListAllController;
use App\Http\Controllers\Arena\ArenaListController;
use App\Http\Controllers\Chat\ChatAppointmentCreateController;
use App\Http\Controllers\Chat\ChatCreateController;
use App\Http\Controllers\Chat\ChatGroupDetailController;
use App\Http\Controllers\Chat\ChatListController;
use App\Http\Controllers\Chat\ChatPrivateDetailController;
use App\Http\Controllers\Chat\ChatTeamCreateController;
use App\Http\Controllers\Friend\FriendCreateController;
use App\Http\Controllers\Friend\FriendListAllController;
use App\Http\Controllers\Friend\FriendUpdateController;
use App\Http\Controllers\HealthCheck\StatusController;
use App\Http\Controllers\Message\MessageListController;
use App\Http\Controllers\Message\MessageCreateController;
use App\Http\Controllers\Preference\UserPreferedThemeController;
use App\Http\Controllers\Sport\SportListAllController;
use App\Http\Controllers\SportPrefered\SportPreferedCreateController;
use App\Http\Controllers\SportPrefered\SportPreferedListAllController;
use App\Http\Controllers\SportPrefered\SportPreferedUpdateController;
use App\Http\Controllers\Team\TeamEditController;
use App\Http\Controllers\Team\TeamExistController;
use App\Http\Controllers\Team\TeamListAllController;
use App\Http\Controllers\Team\TeamCreateController;
use App\Http\Controllers\Team\TeamOwnerAcceptRequestController;
use App\Http\Controllers\Team\TeamOwnerRequestController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UsersListAllController;
use App\Http\Controllers\User\UserTeamAcceptRequestController;
use App\Http\Controllers\User\UserTeamListAllController;
use App\Http\Controllers\User\UserTeamRequestController;
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

// Appointments
Route::get('/appointments', AppointmentsListAllController::class);
Route::post('/appointments', AppointmentsCreateController::class);

// Sports
Route::get('/sports', SportListAllController::class);
Route::get('/sports/material', SportMaterialListAllController::class);

// Team
Route::get('/team', TeamListAllController::class);
Route::get('/team/exist', TeamExistController::class);
Route::post('/team', TeamCreateController::class);
Route::put('/team', TeamEditController::class);
Route::post('/team/user', TeamOwnerRequestController::class); // dono convida membro
Route::put('/team/user', TeamOwnerAcceptRequestController::class); // dono aceita membro

// Friend
Route::get('/friend', FriendListAllController::class);
Route::post('/friend', FriendCreateController::class);
Route::put('/friend', FriendUpdateController::class);

// Message
Route::get('/message', MessageListController::class);
Route::post('/message', MessageCreateController::class);

// Chat
Route::get('/chat/group/detail', ChatGroupDetailController::class);
Route::get('/chat/private/detail', ChatPrivateDetailController::class);
Route::get('/chat', ChatListController::class);
Route::post('/chat', ChatCreateController::class);
Route::post('/chat/team', ChatTeamCreateController::class);
Route::post('/chat/appointment', ChatAppointmentCreateController::class);

// Arena
Route::get('/arenas', ArenaListController::class);
Route::post('/arenas', ArenaCreateController::class);
Route::put('/arenas', ArenaEditController::class);
Route::get('/arenas/admin', ArenaListAllController::class);

// User
Route::get('/users', UsersListAllController::class);
Route::get('/users/team', UserTeamListAllController::class);
Route::post('/users/team', UserTeamRequestController::class); // membro solicita ingresso
Route::put('/users/team', UserTeamAcceptRequestController::class); // membro aceita solicitação
Route::post('/users', UserAuthController::class);
Route::post('/users/admin', UserAuthController::class);
Route::get('/sports/prefered-sports', SportPreferedListAllController::class);
Route::post('/sports/prefered-sports', SportPreferedCreateController::class);
Route::put('/sports/prefered-sports', SportPreferedUpdateController::class);
Route::post('/users/appointments', UserAppointmentRequestController::class);

// Update theme preferences
Route::put('/users/theme', UserPreferedThemeController::class);

