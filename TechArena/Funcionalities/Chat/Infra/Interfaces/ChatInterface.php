<?php

namespace TechArena\Funcionalities\Chat\Infra\Interfaces;

use TechArena\Funcionalities\Chat\Infra\Model\Chat;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;

interface ChatInterface
{
    public function select(User $user1, User $user2): Chat;
    public function selectAll(User $user): array;
    public function selectAllTeamChats(User $user): array;
    public function selectAllAppointmentsChats(User $user): array;
    public function create(bool $is_group_chat = false): Chat;
    public function update(Chat $chat);
    public function delete(Chat $chat);
    public function existUserChat(User $user1, User $user2): bool;
    public function existTeamChat(Team $team): bool;

}