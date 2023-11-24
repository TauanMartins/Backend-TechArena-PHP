<?php

namespace App\Http\Controllers\SportPrefered;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Sport\Infra\Interfaces\SportInterface;
use TechArena\Funcionalities\SportPrefered\Infra\Interfaces\SportPreferedInterface;
use TechArena\Funcionalities\SportPrefered\Infra\Model\SportPrefered;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class SportPreferedCreateController extends Controller
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
            $sports = $request['sports'];
            $allowed = $this->sport->allowed($user);
            if ($allowed) {
                foreach ($sports as $sport) {
                    $prefered = new SportPrefered($user->getId(), $sport);
                    $this->sport->create($prefered);
                }
            }else{
                throw new Exception('Só é possível salvar 4 esportes favoritos.');
            }
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
