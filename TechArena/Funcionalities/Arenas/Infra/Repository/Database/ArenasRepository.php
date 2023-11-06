<?php

namespace TechArena\Funcionalities\Arenas\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Arenas\Infra\Interfaces\ArenasInterface as Base;
use TechArena\Funcionalities\Arenas\Infra\Model\Arena;

class ArenasRepository implements Base
{

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