<?php

namespace TechArena\Funcionalities\UserPreference\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Preference\Infra\Model\Preference;
use TechArena\Funcionalities\UserPreference\Infra\Interfaces\UserPreferencePreferedThemeInterface as Base;
use TechArena\Funcionalities\UserPreference\Infra\Model\UserPreference;
use TechArena\Funcionalities\User\Infra\Model\User;

class UserPreferencePreferedThemeRepository implements Base
{

    public function select(Preference $preference, User $user): UserPreference
    {
        try {
            $userPreferences = [];

            $userPreference = DB::table("user_preference")
                ->where("user_id", $user->getId())
                ->where("preference_id", $preference->getIdPreference())
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
            /** @var Preference $preferences */
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
    public function update(UserPreference $userPreference)
    {
        DB::table("user_preference", 'up')
            ->where(['user_id' => $userPreference->getIdUser()])
            ->update([
                'preference_id' => $userPreference->getIdPreference(),
                'value' => $userPreference->getValue(),
            ]);
    }
    public function delete(UserPreference $userPreference)
    {
    }
}