<?php

namespace App\Http\Controllers\SportPrefered;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\SportPrefered\Infra\Interfaces\SportPreferedInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class SportPreferedListAllController extends Controller
{
    private UserInterface $user;
    private SportPreferedInterface $sport;
    public function __construct(SportPreferedInterface $sport, UserInterface $user)
    {
        $this->sport = $sport;
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {
        try {

            $user = $this->user->selectByUsername($request['username']);
            $sport = $this->sport->selectAll($user);
            return response()->json($sport, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
