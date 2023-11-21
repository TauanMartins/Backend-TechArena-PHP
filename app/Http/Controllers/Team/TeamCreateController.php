<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Mime\MimeTypes;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\Team\Infra\Model\Team as TeamModel;
use TechArena\Funcionalities\Team\Team;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class TeamCreateController extends Controller
{
    private UserInterface $user;
    private ChatInterface $chat;
    private Team $team;
    private AWSInterface $s3;
    public function __construct(UserInterface $user, ChatInterface $chat, Team $team, AWSInterface $s3)
    {
        $this->user = $user;
        $this->chat = $chat;
        $this->team = $team;
        $this->s3 = $s3;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $imageUrl = $this->s3->insertImage('teams', $request['name'], $request['image']);
            $team = new TeamModel(trim($request['name']), trim($request['description']), $imageUrl);
            $this->team->domain($user, $team);
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
