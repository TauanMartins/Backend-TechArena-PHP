<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;

class ArenaCreateController extends Controller
{
    private ArenaInterface $arenas;
    private AWSInterface $s3;
    public function __construct(ArenaInterface $arenas, AWSInterface $s3)
    {
        $this->arenas = $arenas;
        $this->s3 = $s3;
    }
    public function __invoke(Request $request)
    {
        try {
            $image = $request['image'];
            $imageUrl = $this->s3->insertImage('arenas', $request['address'], $image);
            $arena = new Arena(
                $request['address'],
                $request['lat'],
                $request['longitude'],
                $imageUrl,
                $request['is_league_only']
            );
            $arenas = $this->arenas->create($arena);
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
