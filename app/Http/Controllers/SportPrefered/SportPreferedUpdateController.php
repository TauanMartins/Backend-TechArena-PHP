<?php

namespace App\Http\Controllers\SportPrefered;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Sport\Infra\Interfaces\SportInterface;
use TechArena\Funcionalities\SportPrefered\Infra\Interfaces\SportPreferedInterface;
use TechArena\Funcionalities\SportPrefered\Infra\Model\SportPrefered;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class SportPreferedUpdateController extends Controller
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

            DB::beginTransaction();
            try {
                $this->sport->removeAll($user);
                foreach ($sports as $sport) {
                    $prefered = new SportPrefered($user->getId(), $sport);
                    $this->sport->create($prefered);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
