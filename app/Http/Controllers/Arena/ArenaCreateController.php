<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use TechArena\Funcionalities\Sport\Infra\Model\Sport;
use TechArena\Funcionalities\SportArena\Infra\Interfaces\SportArenaInterface;
use TechArena\Funcionalities\SportArena\Infra\Model\SportArena;

class ArenaCreateController extends Controller
{
    private ArenaInterface $arenas;
    private SportArenaInterface $sportArena;
    private AWSInterface $s3;
    public function __construct(ArenaInterface $arenas, AWSInterface $s3, SportArenaInterface $sportArena)
    {
        $this->arenas = $arenas;
        $this->s3 = $s3;
        $this->sportArena = $sportArena;
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
            $sports = $request['sports'];
            DB::beginTransaction();
            try {
                $arena = $this->arenas->create($arena);
                foreach ($sports as $sport) {

                    $sport = new SportArena($sport, $arena->getId());
                    $this->sportArena->create($sport);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
           
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
