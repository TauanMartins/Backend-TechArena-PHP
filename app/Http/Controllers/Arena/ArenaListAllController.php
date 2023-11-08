<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;

class ArenaListAllController extends Controller
{
    private ArenaInterface $arenas;
    public function __construct(ArenaInterface $arenas)
    {
        $this->arenas = $arenas;
    }
    public function __invoke(Request $request)
    {
        $filters = $request->all();
        try {
            $arenas = $this->arenas->selectByFilters($filters);
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
