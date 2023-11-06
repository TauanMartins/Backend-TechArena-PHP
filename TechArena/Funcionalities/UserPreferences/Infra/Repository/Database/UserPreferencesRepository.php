<?php

namespace TechArena\Funcionalities\UserPreferences\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\UserPreferences\Infra\Interfaces\UserPreferencesInterface as Base;
use TechArena\Funcionalities\Users\Infra\Model\User;

class UserPreferencesRepository implements Base
{

    public function select(User $user) 
    {
        try {            
            $preferences = DB::table("preference")->get('*');
            $userPreferences = [];

            foreach ($preferences as $preference) {
                $userPreference = DB::table("user_preference")
                    ->where("user_id", $user->getId())
                    ->where("preference_id", $preference->id)
                    ->first();

                $userPreferences[$preference->desc_preference] = $userPreference ? $userPreference->value : $preference->default_value;
            }

            return $userPreferences;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(User $user)
    {
        try {
            $preferences = DB::table("preference")->get('*');

            foreach ($preferences as $preference) {
                DB::table("user_preference", 'up')->insert([
                    'user_id' => $user->getId(),
                    'preference_id' => $preference->id,
                    'value' => $preference->default_value,
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(User $user)
    {
    }
    public function delete(User $user)
    {
    }
}