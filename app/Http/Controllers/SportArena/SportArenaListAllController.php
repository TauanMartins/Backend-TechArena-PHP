<?php

namespace App\Http\Controllers\SportArena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;

class SportArenaListAllController extends Controller
{
    private ArenaInterface $arenas;
    public function __construct(ArenaInterface $arenas)
    {
        $this->arenas = $arenas;
    }
    public function __invoke(Request $request)
    {
        try {
            $arenas = $this->arenas->selectAll();
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
