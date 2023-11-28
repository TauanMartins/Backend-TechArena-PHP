<?php

namespace App\Http\Controllers\SportArena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\SportArena\Infra\Interfaces\SportArenaInterface;

class SportArenaListAllController extends Controller
{
    private SportArenaInterface $sportArena;
    public function __construct(SportArenaInterface $sportArena)
    {
        $this->sportArena = $sportArena;
    }
    public function __invoke(Request $request)
    {
        try {
            $sportArenas = $this->sportArena->select($request['arena_id']);
            return response()->json($sportArenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
