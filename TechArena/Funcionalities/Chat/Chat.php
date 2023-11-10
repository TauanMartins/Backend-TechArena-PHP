<?php

namespace TechArena\Funcionalities\Chat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\ChatUserInterface;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\Chat\Infra\Model\Chat as ChatModel;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\UserChat\UserChat;

class Chat
{
    private ChatInterface $repositoryChat;
    private UserChat $repositoryUserChat;
    public function __construct(
        ChatInterface $repositoryChat,
        UserChat $repositoryUserChat
    ) {
        $this->repositoryChat = $repositoryChat;
        $this->repositoryUserChat = $repositoryUserChat;
    }
    public function domain(User $user1, User $user2)
    {
        $chatExist = $this->repositoryChat->exist($user1, $user2);
        try {
            DB::beginTransaction();
            if ($chatExist) {
                $chatId = $this->repositoryChat->select($user1, $user2);
                $userChat1 = new UserChatModel($chatId->getId(), $user1->getId());
                $userChat2 = new UserChatModel($chatId->getId(), $user2->getId());
                $this->repositoryUserChat->domain($userChat1, $userChat2);
            } else {
                $chatId = $this->repositoryChat->create();
                $userChat1 = new UserChatModel($chatId->getId(), $user1->getId());
                $userChat2 = new UserChatModel($chatId->getId(), $user2->getId());
                $this->repositoryUserChat->domain($userChat1, $userChat2);
            }
            DB::commit();
            return $chatId->getId();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}