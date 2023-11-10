<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Friend\Infra\Interfaces\FriendInterface;
use TechArena\Funcionalities\Friend\Infra\Model\Friend;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class FriendUpdateController extends Controller
{
    private UserInterface $user;
    private FriendInterface $friend;
    public function __construct(UserInterface $user, FriendInterface $friend)
    {
        $this->user = $user;
        $this->friend = $friend;
    }
    public function __invoke(Request $request)
    {
        try {
            $user1 = $this->user->selectByUsername($request['username_user_1']);
            $user2 = $this->user->selectByUsername($request['username_user_2']);
            $friendship = new Friend($user2->getId(), $user1->getId(), true, true);
            $this->friend->update($friendship);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
