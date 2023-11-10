<?php

namespace TechArena\Funcionalities\User\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface as Base;
use TechArena\Funcionalities\User\Infra\Model\User;

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