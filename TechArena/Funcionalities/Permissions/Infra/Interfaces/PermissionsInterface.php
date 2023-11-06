<?php

namespace TechArena\Funcionalities\Permissions\Infra\Interfaces;
use TechArena\Funcionalities\Permissions\Infra\Model\Permission;

interface PermissionsInterface
{
    public function select(): array;
    public function selectBySlug(string $slug): Permission;

}