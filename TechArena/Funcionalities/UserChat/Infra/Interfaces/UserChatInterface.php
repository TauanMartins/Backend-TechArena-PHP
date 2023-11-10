<?php

namespace TechArena\Funcionalities\UserChat\Infra\Interfaces;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

interface UserChatInterface
{
    public function select(UserChat $userChat): UserChat;
    public function create(UserChat $userChat1);
    public function update(UserChat $userChat);
    public function delete(UserChat $userChat);
    public function exist(UserChat $userChat): bool;
    public function allowed(UserChat $userChat): bool;

}