<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Friend\Infra\Interfaces\FriendInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class FriendListAllController extends Controller
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
            $user = $this->user->selectByUsername($request['username']);
            $friends = $this->friend->selectAll($user);
            $friendsRequested = $this->friend->selectRequested($user);
            $friendsReceived = $this->friend->selectReceived($user);
            return response()->json(['friends' => $friends, 'requested_friends' => $friendsRequested, 'received_friends' => $friendsReceived], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
