<?php

namespace TechArena\Funcionalities\User\Infra\Interfaces;
use TechArena\Funcionalities\User\Infra\Model\User;

interface UserInterface
{
    public function select(string $email): User;
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);
    public function exist(User $user);

}