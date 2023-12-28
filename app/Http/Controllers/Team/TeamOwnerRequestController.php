<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\Team\Team;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\UserTeam;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam as UserTeamModel;

class TeamOwnerRequestController extends Controller
{
    private UserInterface $user;
    private TeamInterface $teamInterface;
    private Team $team;
    private UserTeam $user_team;
    private UserTeamInterface $userTeam;
    public function __construct(UserInterface $user, TeamInterface $teamInterface, Team $team, UserTeamInterface $userTeam, UserTeam $user_team)
    {
        $this->user = $user;
        $this->teamInterface = $teamInterface;
        $this->team = $team;
        $this->user_team = $user_team;
        $this->userTeam = $userTeam;
    }
    public function __invoke(Request $request)
    {
        try {
            $user_owner = $this->user->selectByUsername($request['username_owner']);
            $user_member = $this->user->selectByUsername($request['username_member']);
            $team = $this->teamInterface->selectById($request['team_id']);
            if ($this->userTeam->userIsOwner(new UserTeamModel($user_owner->getId(), $team->getId(), true, true))) {
                $this->team->request_member(new UserTeamModel($user_member->getId(), $team->getId(), true, true), $team);
            } else {
                throw new Exception('Você não possui permissão para alterar informações.');
            }
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
