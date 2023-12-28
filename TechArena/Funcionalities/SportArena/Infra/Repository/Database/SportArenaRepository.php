<?php

namespace TechArena\Funcionalities\SportArena\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Arena\Infra\Model\Arena;
use TechArena\Funcionalities\SportArena\Infra\Interfaces\SportArenaInterface as Base;
use TechArena\Funcionalities\SportArena\Infra\Model\SportArena;

class SportArenaRepository implements Base
{

    public function select(int $arena_id): array
    {
        try {
            $sports = DB::table('sport_arena', 'sa')
            ->join('sport as s', 'sa.sport_id', '=', 's.id')
            ->where('sa.arena_id', '=', $arena_id)
            ->select('s.*', 'sa.arena_id')
            ->get()
            ->toArray();
            return $sports;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(SportArena $sport_arena)
    {
        try {
            $sports = DB::table('sport_arena', 'sa')->insert($sport_arena->toArray());
            return $sports;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete(SportArena $sport_arena)
    {
        try {
            DB::table('sport_arena', 'sa')->where('sa.arena_id', '=', $sport_arena->getArenaId())->where('sa.sport_id', '=', $sport_arena->getSportId())->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function exist(Arena $arena, int $sport_id)
    {
        return;
    }

}