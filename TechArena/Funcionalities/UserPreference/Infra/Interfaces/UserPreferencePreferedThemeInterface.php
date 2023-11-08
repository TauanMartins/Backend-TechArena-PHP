<?php

namespace TechArena\Funcionalities\UserPreference\Infra\Interfaces;
use TechArena\Funcionalities\Preference\Infra\Model\Preference;
use TechArena\Funcionalities\UserPreference\Infra\Model\UserPreference;
use TechArena\Funcionalities\User\Infra\Model\User;

interface UserPreferencePreferedThemeInterface
{
    public function select(Preference $preference, User $user);
    public function create(User $user);
    public function update(UserPreference $userPreference);
    public function delete(UserPreference $userPreference);

}