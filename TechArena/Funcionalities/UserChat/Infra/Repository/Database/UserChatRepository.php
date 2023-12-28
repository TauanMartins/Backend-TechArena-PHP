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
    public function isTeamChat(UserChat $userChat): bool
    {
        try {
            return DB::table('team as t')
                ->join('chat as c', 'c.id', '=', 't.chat_id')
                ->where('t.chat_id', $userChat->getChatId())
                ->exists();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectChatDetail(UserChat $userChat)
    {
        try {
            $teamId = DB::table('team as t')
                ->select('t.id')
                ->join('chat as c', 'c.id', '=', 't.chat_id')
                ->where('c.id', $userChat->getChatId())
                ->first()
                ->id;
            return DB::table('team as t')
                ->select('t.description', 't.created_at')
                ->where('t.id', $teamId)
                ->get()
                ->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectPrivateChatDetail(UserChat $userChat)
    {
        try {
            return DB::table('chat as c')
                ->select('c.created_at')
                ->where('c.id', $userChat->getChatId())
                ->get()
                ->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAppointmentChatDetail(UserChat $userChat)
    {
        try {
            return DB::table('chat as c')
                ->select('c.created_at')
                ->where('c.id', $userChat->getChatId())
                ->get()
                ->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllSolicitationsForTeam(UserChat $userChat)
    {
        try {
            $teamId = DB::table('team as t')
                ->select('t.id')
                ->join('chat as c', 'c.id', '=', 't.chat_id')
                ->where('c.id', $userChat->getChatId())
                ->first()
                ->id;
            return DB::table('user_team as ut')
                ->join('user as u', 'ut.user_id', '=', 'u.id')
                ->select(
                    'u.id',
                    'u.name',
                    'u.username',
                    'u.image',
                    DB::raw("true as request_status")
                )
                ->where('ut.user_accepted', true)
                ->where('ut.team_accepted', false)
                ->where('ut.team_id', $teamId)
                ->get()
                ->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectTeamId(UserChat $userChat)
    {
        try {
            $teamId = DB::table('team as t')
                ->select('t.id')
                ->join('chat as c', 'c.id', '=', 't.chat_id')
                ->where('c.id', $userChat->getChatId())
                ->first()
                ->id;
            $isUserOwner = DB::table('user as u')
                ->join('user_team as ut', 'ut.user_id', '=', 'u.id')
                ->where('ut.team_id', '=', $teamId)
                ->where('u.id', '=', $userChat->getUserId())
                ->where('ut.leader', '=', 'true')
                ->exists();
            return ['teamId' => $teamId, 'isOwner' => $isUserOwner];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllUsersInTeam(UserChat $userChat)
    {
        try {
            $currentUserId = $userChat->getUserId();
            $teamId = DB::table('team as t')
                ->select('t.id')
                ->join('chat as c', 'c.id', '=', 't.chat_id')
                ->where('c.id', $userChat->getChatId())
                ->first()
                ->id;

            return DB::table('team as t')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->leftJoin('friend as f1', function ($join) use ($currentUserId) {
                    $join->on('f1.user_1_id', '=', DB::raw($currentUserId))
                        ->on('f1.user_2_id', '=', 'u.id')
                        ->where('f1.user_1_accepted', true)
                        ->where('f1.user_2_accepted', true);
                })
                ->leftJoin('friend as f2', function ($join) use ($currentUserId) {
                    $join->on('f2.user_2_id', '=', DB::raw($currentUserId))
                        ->on('f2.user_1_id', '=', 'u.id')
                        ->where('f2.user_1_accepted', true)
                        ->where('f2.user_2_accepted', true);
                })
                ->select(
                    'u.id',
                    'u.name',
                    'u.username',
                    'u.image',
                    DB::raw('CASE WHEN f1.user_2_id IS NOT NULL OR f2.user_1_id IS NOT NULL THEN TRUE ELSE FALSE END AS is_friend')
                )
                ->where('t.id', $teamId)
                ->where('u.id', '<>', $currentUserId)
                ->where('ut.user_accepted', '=', true)
                ->where('ut.team_accepted', '=', true)
                ->get()
                ->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllUsersInAppointment(UserChat $userChat)
    {
        try {
            $currentUserId = $userChat->getUserId();
            $appointmentId = DB::table('appointment as a')
                ->select('a.id')
                ->where('a.chat_id', $userChat->getChatId())
                ->first()
                ->id;

            return DB::table('appointment as a')
                ->join('user_appointment as ua', 'ua.appointment_id', '=', 'a.id')
                ->join('user as u', 'u.id', '=', 'ua.user_id')
                ->leftJoin('friend as f1', function ($join) use ($currentUserId) {
                    $join->on('f1.user_1_id', '=', DB::raw($currentUserId))
                        ->on('f1.user_2_id', '=', 'u.id')
                        ->where('f1.user_1_accepted', true)
                        ->where('f1.user_2_accepted', true);
                })
                ->leftJoin('friend as f2', function ($join) use ($currentUserId) {
                    $join->on('f2.user_2_id', '=', DB::raw($currentUserId))
                        ->on('f2.user_1_id', '=', 'u.id')
                        ->where('f2.user_1_accepted', true)
                        ->where('f2.user_2_accepted', true);
                })
                ->select(
                    'u.id',                    
                    DB::raw('CASE WHEN ua.holder IS true THEN u.name || \' - Holder\' ELSE u.name END as name'),
                    'u.username',
                    'u.image',
                    DB::raw('CASE WHEN f1.user_2_id IS NOT NULL OR f2.user_1_id IS NOT NULL THEN TRUE ELSE FALSE END AS is_friend')
                )
                ->where('a.id', $appointmentId)
                ->where('u.id', '<>', $currentUserId)
                ->get()
                ->toArray();
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