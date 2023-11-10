<?php

namespace TechArena\Funcionalities\Permission\Infra\Interfaces;
use TechArena\Funcionalities\Permission\Infra\Model\Permission;

interface PermissionInterface
{
    public function select(): array;
    public function selectBySlug(string $slug): Permission;
    public function selectById(string $id): Permission;

}