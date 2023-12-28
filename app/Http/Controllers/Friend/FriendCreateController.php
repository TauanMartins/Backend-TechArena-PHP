<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Friend\Friend;
use TechArena\Funcionalities\Friend\Infra\Model\Friend as FriendModel;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class FriendCreateController extends Controller
{
    private UserInterface $user;
    private Friend $friend;
    public function __construct(UserInterface $user, Friend $friend)
    {
        $this->user = $user;
        $this->friend = $friend;
    }
    public function __invoke(Request $request)
    {
        try {
            $user1 = $this->user->selectByUsername($request['username_user_1']);
            $user2 = $this->user->selectByUsername($request['username_user_2']);
            $friendship = new FriendModel($user1->getId(), $user2->getId(), true, false);
            $this->friend->domain($friendship);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
