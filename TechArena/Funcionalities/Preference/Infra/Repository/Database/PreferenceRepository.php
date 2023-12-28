<?php

namespace TechArena\Funcionalities\Preference\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Preference\Infra\Interfaces\PreferenceInterface as Base;
use TechArena\Funcionalities\Preference\Infra\Model\Preference;

class PreferenceRepository implements Base
{

    public function select_specific(string $desc_preference): Preference
    {
        try {
            $preferenceDB = DB::table("preference")->where("desc_preference", $desc_preference)->first();
            $preference = Preference::fromArray((array) $preferenceDB);

            return $preference;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function select(): array
    {
        try {
            $preferenceDB = DB::table("preference")->get('*')->toArray();

            return $preferenceDB;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(Preference $preferences)
    {
    }
    public function update(Preference $preferences)
    {
    }
    public function delete(Preference $preferences)
    {
    }
}