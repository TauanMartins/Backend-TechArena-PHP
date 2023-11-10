<?php

namespace TechArena\Funcionalities\Chat\Infra\Interfaces;
use TechArena\Funcionalities\Chat\Infra\Model\Chat;
use TechArena\Funcionalities\User\Infra\Model\User;

interface ChatInterface
{
    public function select(User $user1, User $user2): Chat;
    public function selectAll(User $user): array;
    public function create(): Chat;
    public function update(Chat $chat);
    public function delete(Chat $chat);
    public function exist(User $user1, User $user2): bool;

}