<?php

namespace TechArena\Funcionalities\Users;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Preferences\Infra\Interfaces\PreferencesInterface;
use TechArena\Funcionalities\Users\Infra\Interfaces\UsersInterface;
use TechArena\Funcionalities\Users\Infra\Model\User;

class Users
{
    private UsersInterface $repositoryUser;
    private PreferencesInterface $repositoryPreference;
    public function __construct(
        UsersInterface $repositoryUser,
        PreferencesInterface $repositoryPreference
    ) {
        $this->repositoryUser = $repositoryUser;
        $this->repositoryPreference = $repositoryPreference;
    }
    public function domain(User $user)
    {

        $userExist = $this->repositoryUser->exist($user);

        if ($userExist) {
            $user->setId($this->repositoryUser->select($user)->getId());
        } else {
            try {
                DB::beginTransaction();
                $this->repositoryUser->create($user);
                $this->repositoryPreference->create($user);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
        return [
            'preferences' => $this->repositoryPreference->select($user),
            'user' => $this->repositoryUser->select($user),
        ];

    }
}