<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserTeam\UserTeam;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam as UserTeamModel;

class UserTeamRequestController extends Controller
{
    private UserInterface $user;
    private TeamInterface $team;
    private UserTeam $user_team;
    public function __construct(UserInterface $user, TeamInterface $team, UserTeam $user_team)
    {
        $this->user = $user;
        $this->team = $team;
        $this->user_team = $user_team;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $team = $this->team->selectById($request['team_id']);
            $this->user_team->domain(new UserTeamModel($user->getId(), $team->getId(), true, false));
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
