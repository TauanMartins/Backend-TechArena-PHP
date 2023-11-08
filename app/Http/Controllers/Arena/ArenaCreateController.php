<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;

class ArenaCreateController extends Controller
{
    private ArenaInterface $arenas;
    public function __construct(ArenaInterface $arenas)
    {
        $this->arenas = $arenas;
    }
    public function __invoke(Request $request)
    {
        try {
            $arena = new Arena(
                $request['address'],
                $request['lat'],
                $request['longitude'],
                $request['image'],
                $request['is_league_only']
            );
            $arenas = $this->arenas->create($arena);
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
