<?php

namespace TechArena\Funcionalities\Permissions\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Permissions\Infra\Interfaces\PermissionsInterface as Base;
use TechArena\Funcionalities\Permissions\Infra\Model\Permission;
use TechArena\Funcionalities\Users\Infra\Model\User;

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

}