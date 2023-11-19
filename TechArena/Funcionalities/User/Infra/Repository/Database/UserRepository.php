<?php

namespace TechArena\Funcionalities\User\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Permission\Infra\Model\Permission;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface as Base;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\Permission\Infra\Interfaces\PermissionInterface;

class UserRepository implements Base
{

    public function select(string $email): User
    {
        try {
            $userData = DB::table('public.user', 'u')
                ->where('u.email', '=', $email)
                ->first();
            if (!$userData) {
                throw new Exception('Usuário não encontrado.');
            }
            $user = new User($userData->name, $userData->username, $userData->image, $userData->email, DateTime::createFromFormat('Y-m-d', $userData->dt_birth), $userData->gender, $userData->permission_id);
            $user->setId($userData->id);
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectPermission(string $email): Permission
    {
        try {
            $userPermission = DB::table('user', 'u')
                ->select('u.permission_id')
                ->where('u.email', '=', $email)
                ->first();
            /** @var PermissionInterface $permissionFinder */
            $permissionFinder = app(PermissionInterface::class);
            $permission = $permissionFinder->selectById($userPermission->permission_id);
            return $permission;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function selectByUsername(string $username): User
    {
        try {
            $userData = DB::table('user')
                ->where('username', '=', $username)
                ->first();
            if (!$userData) {
                throw new Exception('Usuário não encontrado.');
            }
            $user = new User($userData->name, $userData->username, $userData->image, $userData->email, DateTime::createFromFormat('Y-m-d', $userData->dt_birth), $userData->gender, $userData->permission_id);
            $user->setId($userData->id);
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllByUsername(string $username): array
    {
        try {
            $users = DB::table('user')
                ->select('id', 'name', 'username', 'image')
                ->where('username', 'like', '%' . strtolower($username) . '%')
                ->get()
                ->toArray();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectUserTeams(User $user): array
    {
        try {
            $users = DB::table('team as t')
                ->select('t.id', 't.name', 't.description', 't.image', 't.chat_id', 'ut.leader')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('u.id', '=', $user->getId())
                ->get()
                ->toArray();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function allowedUserInTeam(User $user, Team $team): bool
    {
        try {
            $users = DB::table('team as t')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('ut.user_id', '=', $user->getId())
                ->where('ut.team_id', '=', $team->getId())
                ->exists();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(User $user)
    {
        try {
            $id = DB::table('public.user')->insertGetId($user->toArray());
            $user->setId($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    public function update(User $user)
    {
    }
    public function delete(User $user)
    {
    }
    public function exist(User $user)
    {
        return DB::table('user', 'u')
            ->where('u.email', '=', $user->getEmail())
            ->exists();
    }
}