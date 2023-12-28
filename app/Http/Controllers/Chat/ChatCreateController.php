<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Chat\Chat;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class ChatCreateController extends Controller
{
    private Chat $chat;
    private UserInterface $user;
    public function __construct(Chat $chat, UserInterface $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {
        try {
            $user1 = $this->user->selectByUsername($request['username_user_1']);
            $user2 = $this->user->selectByUsername($request['username_user_2']);
            $chat_id = $this->chat->domain($user1, $user2);
            return response()->json(['chat_id' => $chat_id], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
