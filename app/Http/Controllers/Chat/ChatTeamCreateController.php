<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Chat\ChatTeam;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class ChatTeamCreateController extends Controller
{
    private ChatTeam $chat;
    private UserInterface $user;
    private TeamInterface $team;
    public function __construct(ChatTeam $chat, UserInterface $user, TeamInterface $team)
    {
        $this->chat = $chat;
        $this->user = $user;
        $this->team = $team;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $team = $this->team->selectById($request['team_id']);
            $chat_id = $this->chat->domain($user, $team);
            return response()->json(['chat_id' => $chat_id], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
