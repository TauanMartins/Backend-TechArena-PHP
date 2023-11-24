<?php

namespace TechArena\Funcionalities\Chat\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface as Base;
use TechArena\Funcionalities\Chat\Infra\Model\Chat;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;

class ChatRepository implements Base
{

    public function select(User $user1, User $user2): Chat
    {
        try {
            $user1Chats = DB::table('user_chat as uc1')
                ->select('uc1.chat_id')
                ->leftJoin('appointment as a1', 'uc1.chat_id', '=', 'a1.chat_id')
                ->leftJoin('team as t1', 'uc1.chat_id', '=', 't1.chat_id')
                ->where('uc1.user_id', $user1->getId())
                ->whereNull('a1.id')
                ->whereNull('t1.id');

            $user2Chats = DB::table('user_chat as uc2')
                ->select('uc2.chat_id')
                ->leftJoin('appointment as a2', 'uc2.chat_id', '=', 'a2.chat_id')
                ->leftJoin('team as t2', 'uc2.chat_id', '=', 't2.chat_id')
                ->where('uc2.user_id', $user2->getId())
                ->whereNull('a2.id')
                ->whereNull('t2.id');

            $chatRecord = DB::table('chat as c')
                ->joinSub($user1Chats, 'user1_chats', function ($join) {
                    $join->on('c.id', '=', 'user1_chats.chat_id');
                })
                ->joinSub($user2Chats, 'user2_chats', function ($join) {
                    $join->on('c.id', '=', 'user2_chats.chat_id');
                })
                ->first();
            $chat = Chat::fromArray();
            $chat->setId($chatRecord->id);
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
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');
            $subQuery = DB::table('chat as c')
                ->join('user_chat as uc', 'c.id', '=', 'uc.chat_id')
                ->join('user as u', 'u.id', '=', 'uc.user_id')
                ->where('u.id', $user->getId())
                ->where('c.is_group_chat', '=', true)
                ->select('c.id');

            $userChats = DB::table('appointment as a')
                ->join('chat as c', 'a.chat_id', '=', 'c.id')
                ->join('sport_arena as sa', 'a.sport_arena_id', '=', 'sa.id')
                ->join('arena as ar', 'sa.arena_id', '=', 'ar.id')
                ->join('schedule as s', 's.id', '=', 'a.schedule_id')
                ->leftJoin('message as m', 'c.last_message_id', '=', 'm.id')
                ->whereIn('c.id', $subQuery)
                ->whereRaw("CONCAT(a.date, ' ', s.horary)::timestamp > ?", [$currentDateTime])
                ->select('c.id', DB::raw('ar.address|| \' - \'||  to_char(a.date, \'DD/MM/YYYY\')|| \' - \' || s.horary as name'), 'ar.image', DB::raw('CASE WHEN LENGTH(m.message) > 25 THEN SUBSTRING(m.message FROM 1 FOR 25) || \'...\' ELSE m.message END as last_message'))
                ->get()
                ->toArray();

            return $userChats;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(bool $is_group_chat = false): Chat
    {
        try {
            $chat = new Chat();
            $chat->setIsGroupChat($is_group_chat);
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
    public function existUserChat(User $user1, User $user2): bool
    {
        try {
            $user1Chats = DB::table('user_chat as uc1')
                ->select('uc1.chat_id')
                ->where('uc1.user_id', $user1->getId())
                ->leftJoin('appointment as a', 'uc1.chat_id', '=', 'a.chat_id')
                ->leftJoin('team as t', 'uc1.chat_id', '=', 't.chat_id')
                ->whereNull('a.id')
                ->whereNull('t.id');

            $user2Chats = DB::table('user_chat as uc2')
                ->select('uc2.chat_id')
                ->where('uc2.user_id', $user2->getId())
                ->leftJoin('appointment as a', 'uc2.chat_id', '=', 'a.chat_id')
                ->leftJoin('team as t', 'uc2.chat_id', '=', 't.chat_id')
                ->whereNull('a.id')
                ->whereNull('t.id');

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

    public function existAppointmentChat(Appointment $appointment): bool
    {
        try {
            $exists = DB::table('chat as c')
                ->join('appointment as a', 'a.chat_id', '=', 'c.id')
                ->where('a.chat_id', $appointment->getChatId())
                ->exists();
            return $exists;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function existTeamChat(Team $team): bool
    {
        try {
            $exists = DB::table('chat as c')
                ->join('team as t', 't.chat_id', '=', 'c.id')
                ->where('t.chat_id', $team->getChatId())
                ->exists();
            return $exists;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}