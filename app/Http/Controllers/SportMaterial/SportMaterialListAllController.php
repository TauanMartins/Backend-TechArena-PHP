<?php

namespace App\Http\Controllers\SportMaterial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Sport\Infra\Interfaces\SportInterface;

class SportMaterialListAllController extends Controller
{
    private SportInterface $sport;
    public function __construct(SportInterface $sport)
    {
        $this->sport = $sport;
    }
    public function __invoke(Request $request)
    {
        try {
            $sport = $this->sport->selectSportMaterialAll($request['sport_id']);
            return response()->json($sport, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
