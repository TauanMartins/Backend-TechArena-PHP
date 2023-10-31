<?php

namespace TechArena\Funcionalities\Users\Infra\Interfaces;
use TechArena\Funcionalities\Users\Infra\Model\User;

interface UsersInterface
{
    public function select(User $user): User;
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);
    public function exist(User $user);

}