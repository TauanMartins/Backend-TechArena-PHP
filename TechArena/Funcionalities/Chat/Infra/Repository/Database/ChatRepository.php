<?php

namespace TechArena\Funcionalities\Chat\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface as Base;
use TechArena\Funcionalities\Chat\Infra\Model\Chat;
use TechArena\Funcionalities\User\Infra\Model\User;

class ChatRepository implements Base
{

    public function select(User $user1, User $user2): Chat
    {
        try {
            $user1Chats = DB::table('user_chat as uc1')
                ->select('uc1.chat_id')
                ->where('uc1.user_id', $user1->getId());

            // Subconsulta para chats do usuário 2
            $user2Chats = DB::table('user_chat as uc2')
                ->select('uc2.chat_id')
                ->where('uc2.user_id', $user2->getId());

            // Busca pelo chat_id que está presente em ambas as subconsultas
            $chatId = DB::table('chat as c')
                ->joinSub($user1Chats, 'user1_chats', function ($join) {
                    $join->on('c.id', '=', 'user1_chats.chat_id');
                })
                ->joinSub($user2Chats, 'user2_chats', function ($join) {
                    $join->on('c.id', '=', 'user2_chats.chat_id');
                })
                ->first(['c.id']); // Seleciona apenas os registros distintos
            $chat = Chat::fromArray();
            $chat->setId($chatId->id);
            return $chat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAll(User $user): array
    {
        try {
            $subQuery = DB::table('chat as c')
                ->join('user_chat as uc', 'c.id', '=', 'uc.chat_id')
                ->join('user as u', 'u.id', '=', 'uc.user_id')
                ->where('u.id', $user->getId())
                ->where('c.is_group_chat', '=', false)
                ->select('c.id');

            $userChats = DB::table('user_chat as uc')
                ->join('user as u', 'uc.user_id', '=', 'u.id')
                ->join('chat as c', 'uc.chat_id', '=', 'c.id')
                ->leftJoin('message as m', 'c.last_message_id', '=', 'm.id')
                ->whereIn('uc.chat_id', $subQuery)
                ->where('u.id', '<>', $user->getId())
                ->select('c.id', 'u.name', 'u.image', DB::raw('CASE WHEN LENGTH(m.message) > 25 THEN SUBSTRING(m.message FROM 1 FOR 25) || \'...\' ELSE m.message END as last_message'))
                ->get()
                ->toArray();

            return $userChats;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllTeamChats(User $user): array
    {
        try {
            $subQuery = DB::table('chat as c')
                ->join('user_chat as uc', 'c.id', '=', 'uc.chat_id')
                ->join('user as u', 'u.id', '=', 'uc.user_id')
                ->where('u.id', $user->getId())
                ->where('c.is_group_chat', '=', true)
                ->select('c.id');

            $userChats = DB::table('team as t')
                ->join('chat as c', 't.chat_id', '=', 'c.id')
                ->leftJoin('message as m', 'c.last_message_id', '=', 'm.id')
                ->whereIn('c.id', $subQuery)
                ->select('c.id', 't.name', 't.image', DB::raw('CASE WHEN LENGTH(m.message) > 25 THEN SUBSTRING(m.message FROM 1 FOR 25) || \'...\' ELSE m.message END as last_message'))
                ->get()
                ->toArray();

            return $userChats;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllAppointmentsChats(User $user): array
    {
        try {
            $subQuery = DB::table('chat as c')
                ->join('user_chat as uc', 'c.id', '=', 'uc.chat_id')
                ->join('user as u', 'u.id', '=', 'uc.user_id')
                ->where('u.id', $user->getId())
                ->where('c.is_group_chat', '=', true)
                ->select('c.id');

            $userChats = DB::table('appointment as a')
                ->join('chat as c', 'a.chat_id', '=', 'c.id')
                ->join('sport_arena as sa', 'a.sport_arena_id','=', 'sa.id')
                ->join('arena as ar', 'sa.arena_id','=', 'ar.id')
                ->leftJoin('message as m', 'c.last_message_id', '=', 'm.id')
                ->whereIn('c.id', $subQuery)
                ->select('c.id', 'ar.address', 'ar.image', DB::raw('CASE WHEN LENGTH(m.message) > 25 THEN SUBSTRING(m.message FROM 1 FOR 25) || \'...\' ELSE m.message END as last_message'))
                ->get()
                ->toArray();

            return $userChats;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(): Chat
    {
        try {
            $chat = new Chat();
            $id = DB::table('chat')->insertGetId($chat->toArrayInsert());
            $chat->setId($id);
            return $chat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(Chat $chat)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete(Chat $chat)
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function exist(User $user1, User $user2): bool
    {
        try {
            $user1Chats = DB::table('user_chat as uc1')
                ->select('uc1.chat_id')
                ->where('uc1.user_id', $user1->getId());

            // Subconsulta para chats do usuário 2
            $user2Chats = DB::table('user_chat as uc2')
                ->select('uc2.chat_id')
                ->where('uc2.user_id', $user2->getId());

            // Verifica se existe algum chat_id que está presente em ambas as subconsultas
            $exists = DB::table('chat as c')
                ->joinSub($user1Chats, 'user1_chats', function ($join) {
                    $join->on('c.id', '=', 'user1_chats.chat_id');
                })
                ->joinSub($user2Chats, 'user2_chats', function ($join) {
                    $join->on('c.id', '=', 'user2_chats.chat_id');
                })
                ->exists();

            return $exists;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}