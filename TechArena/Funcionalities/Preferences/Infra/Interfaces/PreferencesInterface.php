<?php

namespace TechArena\Funcionalities\Preferences\Infra\Interfaces;
use TechArena\Funcionalities\Users\Infra\Model\User;

interface PreferencesInterface
{
    public function select(User $user);
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);

}