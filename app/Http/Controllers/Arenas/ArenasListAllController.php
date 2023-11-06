<?php

namespace App\Http\Controllers\Arenas;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arenas\Infra\Interfaces\ArenasInterface;

class ArenasListAllController extends Controller
{
    private ArenasInterface $arenas;
    public function __construct(ArenasInterface $arenas)
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
