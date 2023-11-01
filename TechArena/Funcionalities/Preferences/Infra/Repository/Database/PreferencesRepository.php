<?php

namespace TechArena\Funcionalities\Preferences\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Preferences\Infra\Interfaces\PreferencesInterface as Base;
use TechArena\Funcionalities\Preferences\Infra\Model\Preferences;

class PreferencesRepository implements Base
{

    public function select_specific(string $desc_preference): Preferences
    {
        try {
            $preferenceDB = DB::table("preference")->where("desc_preference", $desc_preference)->first();
            $preference = Preferences::fromArray((array) $preferenceDB);

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

    public function create(Preferences $preferences)
    {
    }
    public function update(Preferences $preferences)
    {
    }
    public function delete(Preferences $preferences)
    {
    }
}