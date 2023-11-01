<?php

namespace TechArena\Funcionalities\UserPreferences\Infra\Interfaces;
use TechArena\Funcionalities\Preferences\Infra\Model\Preferences;
use TechArena\Funcionalities\UserPreferences\Infra\Model\UserPreference;
use TechArena\Funcionalities\Users\Infra\Model\User;

interface UserPreferencePreferedThemeInterface
{
    public function select(Preferences $preference, User $user);
    public function create(User $user);
    public function update(UserPreference $userPreference);
    public function delete(UserPreference $userPreference);

}