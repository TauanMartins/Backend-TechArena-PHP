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

    public function select(UserChat $userChat, string|null $cursor): array
    {
        try {
            $messageDB = DB::table('message as m')
                ->select('m.id', 'm.message', 'm.created_at', 'm.chat_id', 'u.username')
                ->join('user as u', 'u.id', '=', 'm.user_id')
                ->where('m.chat_id', $userChat->getChatId())
                ->orderBy('m.created_at', 'desc')
                ->cursorPaginate(20, ['*'], 'cursor', $cursor)
                ->toArray();
            return array_reverse($messageDB);
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