<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;

class TeamListAllController extends Controller
{
    private TeamInterface $team;
    public function __construct(TeamInterface $team)
    {
        $this->team = $team;
    }
    public function __invoke(Request $request)
    {
        try {
            $search = $request->get("search");
            $response = $this->team->selectAllByName(trim($search));
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
