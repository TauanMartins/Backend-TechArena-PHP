<?php

namespace TechArena\Funcionalities\Message\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Message\Infra\Interfaces\MessageInterface as Base;
use TechArena\Funcionalities\Message\Infra\Model\Message;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class MessageRepository implements Base
{

    public function select(UserChat $userChat, int $limit, int $offset): array
    {
        try {
            $messageDB = DB::table('message as m')
            ->select('m.id','m.message','m.created_at','m.chat_id','u.username')
                ->join('user as u','u.id','=','m.user_id')
                ->where('user_id', $userChat->getUserId())
                ->where('chat_id', $userChat->getChatId())
                ->orderBy('created_at', 'asc')
                ->limit($limit)
                ->offset($offset)
                ->get()
                ->toArray();
            return $messageDB;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(Message $message): void
    {
        try {
            $id = DB::table('message')->insertGetId($message->toArrayToInsert());
            DB::table('chat')->where('id', $message->getChatId())->update(['last_message_id' => $id]);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update()
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete()
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function exist(): bool
    {
        try {
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}