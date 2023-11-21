<?php

namespace TechArena\Funcionalities\UserTeam\Infra\Interfaces;

use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam;

interface UserTeamInterface
{
    public function selectUserTeams(User $user): array;
    public function selectRequested(User $user): array;
    public function selectReceived(User $user): array;
    public function allowedUserInTeam(UserTeam $userTeam): bool;
    public function userIsOwner(UserTeam $userTeam): bool;
    public function insertUserInTeam(UserTeam $userTeam, bool $leader);
    public function acceptUserInTeam(UserTeam $userTeam);    
    public function exist(UserTeam $userTeam): bool;

}