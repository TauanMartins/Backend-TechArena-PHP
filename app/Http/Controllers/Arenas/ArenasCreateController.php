<?php

namespace App\Http\Controllers\Arenas;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arenas\Infra\Interfaces\ArenasInterface;
use TechArena\Funcionalities\Arenas\Infra\Model\Arena;

class ArenasCreateController extends Controller
{
    private ArenasInterface $arenas;
    public function __construct(ArenasInterface $arenas)
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
