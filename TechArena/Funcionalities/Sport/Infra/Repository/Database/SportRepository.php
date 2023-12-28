<?php

namespace TechArena\Funcionalities\Sport\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Sport\Infra\Interfaces\SportInterface as Base;

class SportRepository implements Base
{

    public function selectAll(): array
    {
        try {
            $sports = DB::table('sport')->get()->toArray();
            return $sports;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectSportMaterialAll(int $sport_id): array
    {
        try {
            $sportMaterials = DB::table('sport_material as sm')
                ->join('sport as s', 's.id', '=', 'sm.sport_id')
                ->join('material as m', 'm.id', '=', 'sm.material_id')
                ->where('sm.related_to_local', false)
                ->where('s.id', $sport_id)
                ->select('sm.id', 's.name as sport_name', 'm.description as description')
                ->get()
                ->toArray();
            return $sportMaterials;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}