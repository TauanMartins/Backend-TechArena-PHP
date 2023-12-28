<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;

class ArenaListController extends Controller
{
    private ArenaInterface $arenas;
    public function __construct(ArenaInterface $arenas)
    {
        $this->arenas = $arenas;
    }
    public function __invoke(Request $request)
    {
        $lat = $request->input('lat');
        $longitude = $request->input('longitude');
        try {
            $arenas = $this->arenas->selectByFilters($lat, $longitude);
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
