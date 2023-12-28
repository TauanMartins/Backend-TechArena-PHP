<?php

namespace TechArena\Funcionalities\SportPrefered\Infra\Interfaces;
use TechArena\Funcionalities\SportPrefered\Infra\Model\SportPrefered;
use TechArena\Funcionalities\User\Infra\Model\User;

interface SportPreferedInterface
{
    public function selectAll(User $user): array;
    public function create(SportPrefered $sportPrefered): void;
    public function update(SportPrefered $sportPrefered): void;
    public function removeAll(User $user): void;
    public function allowed(User $user): bool;

}