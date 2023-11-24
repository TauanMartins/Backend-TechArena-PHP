<?php

namespace TechArena\Funcionalities\Arena\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface as Base;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;

class ArenaRepository implements Base
{

    public function selectAll(): array
    {
        try {
            $query = DB::table('arena')
                ->get()
                ->toArray();

            return $query;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function select(int $id): Arena
    {
        try {
            $query = DB::table('arena')
                ->where('id', '=', $id)
                ->first();

            $arena = new Arena($query->address, $query->lat, $query->longitude, $query->image, $query->is_league_only);

            return $arena;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectByFilters(array $filters): array
    {
        try {
            $query = DB::table('arena');

            if (isset($filters['address'])) {
                $query->where('address', 'LIKE', '%' . $filters['address'] . '%');
                unset($filters['address']);
            }

            // Aplique os outros filtros
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }

            $arenas = $query->get()->all();

            return $arenas;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectBySport(int $sport_id): array
    {
        try {
            $arenas = DB::table('arena a')
                ->join('sport_arena as sa', 'sa.arena_id', '=', 'a.id')
                ->where('sport_id', '=', $sport_id)
                ->get()
                ->toArray();


            return $arenas;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectSpecificBySport(int $sport_id, int $arena_id): int
    {
        try {
            return DB::table('arena as a')
                ->select('sa.id')
                ->join('sport_arena as sa', 'sa.arena_id', '=', 'a.id')
                ->where('sa.sport_id', '=', $sport_id)
                ->where('sa.arena_id', '=', $arena_id)
                ->first()
                ->id;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(Arena $arena)
    {
        try {
            DB::table('arena')->insert($arena->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(Arena $arena)
    {
        try {
            DB::table('arena', 'a')
                ->where(['a.id' => $arena->getId()])
                ->update([
                    'address' => $arena->getAddress(),
                    'lat' => $arena->getLat(),
                    'longitude' => $arena->getLongitude(),
                    'image' => $arena->getImage(),
                    'is_league_only' => $arena->is_league_only(),
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete(Arena $arena)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function exist(Arena $arena)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}