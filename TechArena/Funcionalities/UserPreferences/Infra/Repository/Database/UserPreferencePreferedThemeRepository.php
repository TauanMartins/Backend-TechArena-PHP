<?php

namespace TechArena\Funcionalities\UserPreferences\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Preferences\Infra\Model\Preferences;
use TechArena\Funcionalities\UserPreferences\Infra\Interfaces\UserPreferencePreferedThemeInterface as Base;
use TechArena\Funcionalities\UserPreferences\Infra\Model\UserPreference;
use TechArena\Funcionalities\Users\Infra\Model\User;

class UserPreferencePreferedThemeRepository implements Base
{

    public function select(Preferences $preference, User $user): UserPreference
    {
        try {
            $userPreferences = [];

            $userPreference = DB::table("public.user_preference")
                ->where("user_id", $user->getId())
                ->where("preferences_id", $preference->getIdPreference())
                ->first();
            $userPreferences[$preference->desc_preference] = $userPreference ? $userPreference->value : $preference->getDefaultValue();

            return UserPreference::fromArray($userPreferences);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(User $user)
    {
        try {
            /** @var Preferences $preferences */
            $preferences = DB::table("preference")->get('*');

            foreach ($preferences as $preference) {
                DB::table("user_preference", 'up')->insert([
                    'user_id' => $user->getId(),
                    'preferences_id' => $preference->id,
                    'value' => $preference->default_value,
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(UserPreference $userPreference)
    {
        DB::table("user_preference", 'up')
            ->where(['user_id' => $userPreference->getIdUser()])
            ->update([
                'preferences_id' => $userPreference->getIdPreference(),
                'value' => $userPreference->getValue(),
            ]);
    }
    public function delete(UserPreference $userPreference)
    {
    }
}