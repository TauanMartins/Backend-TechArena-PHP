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
}