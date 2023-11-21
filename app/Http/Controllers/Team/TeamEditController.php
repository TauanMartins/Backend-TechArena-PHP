<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Mime\MimeTypes;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\Team\Infra\Model\Team as TeamModel;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam;

class TeamEditController extends Controller
{
    private UserInterface $user;
    private UserTeamInterface $userTeam;
    private ChatInterface $chat;
    private TeamInterface $team;
    private AWSInterface $s3;
    public function __construct(UserInterface $user, UserTeamInterface $userTeam, ChatInterface $chat, TeamInterface $team, AWSInterface $s3)
    {
        $this->user = $user;
        $this->userTeam = $userTeam;
        $this->chat = $chat;
        $this->team = $team;
        $this->s3 = $s3;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $team = $this->team->selectById($request['team_id']);
            if ($this->userTeam->userIsOwner(new UserTeam($user->getId(), $team->getId(), true, true))) {
                if ($team->getImage() !== $request['image']) {
                    $imageUrl = $this->s3->editImage('teams', $team->getImage() ? $team->getName() : null, $request['name'], $request['image']);
                } else {
                    $imageUrl = $team->getImage(); // Mantém a imagem atual, já que não houve mudança
                }
                $newTeam = new TeamModel($request['name'], $request['description'], $imageUrl);
                $newTeam->setId($request['team_id']);
                $this->team->update($newTeam);
            } else {
                throw new Exception('Você não possui permissão para alterar informações.');
            }
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
