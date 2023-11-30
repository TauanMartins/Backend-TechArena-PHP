<?php

namespace TechArena\Funcionalities\Horary\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Horary\Infra\Interfaces\HoraryInterface as Base;

class HoraryRepository implements Base
{

    public function select(int $sport_id, int $arena_id, DateTime $date): array
    {
        try {
            $dateString = $date->format('Y-m-d');

            $horarys = DB::table('schedule as s')
                ->select('s.*')
                ->whereNotExists(function ($query) use ($sport_id, $arena_id, $dateString) {
                    $query->select(DB::raw(1))
                        ->from('appointment as a')
                        ->join('sport_arena as sa', 'a.sport_arena_id', '=', 'sa.id')
                        ->where('sa.arena_id', '=', $arena_id)
                        ->where('sa.sport_id', '=', $sport_id)
                        ->where('a.date', '=', $dateString)
                        ->whereColumn('a.schedule_id', 's.id');
                })
                ->get()
                ->toArray();
            return $horarys;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}