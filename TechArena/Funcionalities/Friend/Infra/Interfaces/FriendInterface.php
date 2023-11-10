<?php

namespace TechArena\Funcionalities\Friend\Infra\Interfaces;

use TechArena\Funcionalities\Friend\Infra\Model\Friend;
use TechArena\Funcionalities\User\Infra\Model\User;

interface FriendInterface
{
    public function selectAll(User $user): array;
    public function selectRequested(User $user): array;
    public function selectReceived(User $user): array;
    public function create(Friend $friend): void;
    public function update(Friend $friend);
    public function delete();
    public function exist(Friend $friend): bool;

}