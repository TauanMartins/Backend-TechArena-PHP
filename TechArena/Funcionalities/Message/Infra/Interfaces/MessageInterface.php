<?php

namespace TechArena\Funcionalities\Message\Infra\Interfaces;
use TechArena\Funcionalities\Message\Infra\Model\Message;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

interface MessageInterface
{
    public function select(UserChat $userChat, string|null $cursor);
    public function create(Message $message);
    public function update();
    public function delete();
    public function exist();

}