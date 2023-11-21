<?php

namespace TechArena\Funcionalities\User;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\UserPreference\Infra\Interfaces\UserPreferenceInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\User\Infra\Model\User as UserModel;

class User
{
    private UserInterface $repositoryUser;
    private UserPreferenceInterface $repositoryPreference;
    public function __construct(
        UserInterface $repositoryUser,
        UserPreferenceInterface $repositoryPreference
    ) {
        $this->repositoryUser = $repositoryUser;
        $this->repositoryPreference = $repositoryPreference;
    }
    public function domain(UserModel $user)
    {

        $userExist = $this->repositoryUser->exist($user);

        if ($userExist) {
            $user->setId($this->repositoryUser->select($user->getEmail())->getId());
        } else {
            try {
                DB::beginTransaction();
                $this->repositoryUser->create($user);
                $this->repositoryPreference->create($user);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }

        $preferences = $this->repositoryPreference->select($user);
        $permission = $this->repositoryUser->selectPermission($user->getEmail());
        return [
            'preferences' => $preferences,
            'user' => [
                'permission' => $permission->getSymbol(),
                'username' => $user->getUsername()
            ],
        ];

    }
}