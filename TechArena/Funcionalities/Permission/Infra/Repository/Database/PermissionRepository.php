<?php

namespace TechArena\Funcionalities\Permission\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Permission\Infra\Interfaces\PermissionInterface as Base;
use TechArena\Funcionalities\Permission\Infra\Model\Permission;

class PermissionRepository implements Base
{

    public function select(): array
    {
        try {
            $permissions = DB::table('permission', 'p')
                ->get()
                ->toArray();
            return $permissions;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectBySlug(string $slug): Permission
    {
        try {
            $permission = DB::table('permission', 'p')
                ->where('p.slug', '=', $slug)
                ->first();

            return Permission::fromArray((array) $permission);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectById(string $id): Permission
    {
        try {
            $permission = DB::table('permission', 'p')
                ->where('p.id', '=', $id)
                ->first();

            return Permission::fromArray((array) $permission);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}