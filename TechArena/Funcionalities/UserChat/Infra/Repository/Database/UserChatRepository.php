<?php

namespace TechArena\Funcionalities\UserChat\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface as Base;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class UserChatRepository implements Base
{

    public function select(UserChat $userChat): UserChat
    {
        try {
            $chatDB = DB::table('chat');
            $chat = UserChat::fromArray((array) $chatDB);
            return $chat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(UserChat $userChat)
    {
        try {
            return DB::table('user_chat')->insert($userChat->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(UserChat $userChat)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete(UserChat $userChat)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function exist(UserChat $userChat): bool
    {
        try {
            return DB::table('user_chat as uc') 
                ->where('uc.user_id', $userChat->getUserId())
                ->where('uc.chat_id', $userChat->getChatId()) 
                ->exists();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function allowed(UserChat $userChat): bool
    {
        try {
            return DB::table('user_chat as uc') 
                ->where('uc.user_id', $userChat->getUserId())
                ->where('uc.chat_id', $userChat->getChatId()) 
                ->exists();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}