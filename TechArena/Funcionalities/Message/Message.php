<?php

namespace TechArena\Funcionalities\Message;

use Exception;
use TechArena\Funcionalities\Message\Infra\Interfaces\MessageInterface;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\Message\Infra\Model\Message as MessageModel;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class Message
{
    private UserChatInterface $userChat;
    private MessageInterface $message;
    public function __construct(UserChatInterface $userChat, MessageInterface $message)
    {
        $this->userChat = $userChat;
        $this->message = $message;
    }
    public function domain(UserChat $userChat, callable $action)
    {

        $allowed = $this->userChat->allowed($userChat);

        if (!$allowed) {
            throw new Exception("Usuário não permitido.");
        }

        return $action();
    }

    public function createMessage(UserChat $userChat, MessageModel $message)
    {
        return $this->domain($userChat, function () use ($message) {
            $this->message->create($message);
        });
    }

    public function listMessages(UserChat $userChat, string $cursor)
    {
        return $this->domain($userChat, function () use ($userChat, $cursor) {
            return $this->message->select($userChat, $cursor);
        });
    }
}