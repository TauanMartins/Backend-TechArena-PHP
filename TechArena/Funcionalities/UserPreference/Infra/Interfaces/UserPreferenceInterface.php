<?php

namespace TechArena\Funcionalities\UserPreference\Infra\Interfaces;
use TechArena\Funcionalities\User\Infra\Model\User;

interface UserPreferenceInterface
{
    public function select(User $user);
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);

}