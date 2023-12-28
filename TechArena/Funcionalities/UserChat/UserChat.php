<?php

namespace TechArena\Funcionalities\UserChat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;

class UserChat
{
    private UserChatInterface $repositoryUserChat;
    public function __construct(
        UserChatInterface $repositoryUserChat
    ) {
        $this->repositoryUserChat = $repositoryUserChat;
    }
    public function domain(UserChatModel $userChat1, UserChatModel $userChat2)
    {
        $userChatExist1 = $this->repositoryUserChat->exist($userChat1);
        $userChatExist2 = $this->repositoryUserChat->exist($userChat2);

        try {
            
            DB::beginTransaction();
            if (!$userChatExist1) {
                $this->repositoryUserChat->create($userChat1);
            }
            if (!$userChatExist2) {
                $this->repositoryUserChat->create($userChat2);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }
}