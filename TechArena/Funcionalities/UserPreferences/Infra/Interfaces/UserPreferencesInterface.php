<?php

namespace TechArena\Funcionalities\UserPreferences\Infra\Interfaces;
use TechArena\Funcionalities\Users\Infra\Model\User;

interface UserPreferencesInterface
{
    public function select(User $user);
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);

}