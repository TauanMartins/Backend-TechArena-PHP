<?php

namespace TechArena\Funcionalities\Arena\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface as Base;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;

class ArenaRepository implements Base
{

    public function select(int $id): Arena
    {
        try {
            $query = DB::table('arena')
                ->where('id', '=', $id)
                ->first();

            $arena = new Arena($query['address'], $query['lat'], $query['longitude'], $query['image'], $query['is_league_only']);

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
            return;
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