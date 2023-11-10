<?php

namespace TechArena\Funcionalities\User\Infra\Interfaces;
use TechArena\Funcionalities\Permission\Infra\Model\Permission;
use TechArena\Funcionalities\User\Infra\Model\User;

interface UserInterface
{
    public function select(string $email): User;
    public function selectPermission(string $email): Permission;
    public function selectByUsername(string $username): User;
    public function selectAllByUsername(string $username): array;
    public function create(User $user);
    public function update(User $user);
    public function delete(User $user);
    public function exist(User $user);

}