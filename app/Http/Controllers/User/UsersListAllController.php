<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class UsersListAllController extends Controller
{

    private UserInterface $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {
        try {
            $search = $request->get("search");
            $response = $this->user->selectAllByUsername($search);
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
