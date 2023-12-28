<?php

namespace TechArena\Funcionalities\UserTeam\Infra\Repository\Database;

use Exception;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface as Base;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam as UserTeamModel;

class UserTeamRepository implements Base
{

    public function selectAllByUsername(string $username): array
    {
        try {
            $users = DB::table('user')
                ->select('id', 'name', 'username', 'image')
                ->whereRaw('LOWER(username) LIKE ?', ['%' . strtolower($username) . '%'])
                ->get()
                ->toArray();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectRequested(User $user): array
    {
        try {
            $team_requested = DB::table('team as t')
                ->select('t.id', 't.name', 't.description', 't.image', 't.chat_id', 'ut.leader')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('u.id', '=', $user->getId())
                ->where('ut.user_accepted', '=', true)
                ->where('ut.team_accepted', '=', false)
                ->get()
                ->toArray();
            return $team_requested;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectReceived(User $user): array
    {
        try {
            $team_requested = DB::table('team as t')
                ->select('t.id', 't.name', 't.description', 't.image', 't.chat_id', 'ut.leader')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('u.id', '=', $user->getId())
                ->where('ut.user_accepted', '=', false)
                ->where('ut.team_accepted', '=', true)
                ->get()
                ->toArray();
            return $team_requested;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectUserTeams(User $user): array
    {
        try {
            $users = DB::table('team as t')
                ->select('t.id', 't.name', 't.description', 't.image', 't.chat_id', 'ut.leader')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('u.id', '=', $user->getId())
                ->where('ut.user_accepted', '=', true)
                ->where('ut.team_accepted', '=', true)
                ->get()
                ->toArray();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function userIsOwner(UserTeamModel $userTeam): bool
    {
        try {
            $users = DB::table('team as t')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('ut.user_id', '=', $userTeam->getUserId())
                ->where('ut.team_id', '=', $userTeam->getTeamId())
                ->where('ut.leader', '=', true)
                ->exists();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function allowedUserInTeam(UserTeamModel $userTeam): bool
    {
        try {
            $users = DB::table('team as t')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'u.id', '=', 'ut.user_id')
                ->where('ut.user_id', '=', $userTeam->getUserId())
                ->where('ut.team_id', '=', $userTeam->getTeamId())
                ->where('ut.team_accepted', '=', true)
                ->exists();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function insertUserInTeam(UserTeamModel $userTeam, bool $leader)
    {
        try {
            DB::table('user_team')
                ->insert([
                    'user_id' => $userTeam->getUserId(),
                    'team_id' => $userTeam->getTeamId(),
                    'user_accepted' => $userTeam->getUserAccepted(),
                    'team_accepted' => $userTeam->getTeamAccepted(),
                    'leader' => $leader
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    public function acceptUserInTeam(UserTeamModel $userTeam)
    {
        try {
            DB::table('user_team')
                ->where('user_id', '=', $userTeam->getUserId())
                ->where('team_id', '=', $userTeam->getTeamId())
                ->update([
                    'user_id' => $userTeam->getUserId(),
                    'team_id' => $userTeam->getTeamId(),
                    'user_accepted' => $userTeam->getUserAccepted(),
                    'team_accepted' => $userTeam->getTeamAccepted()
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    public function exist(UserTeamModel $userTeam): bool
    {
        try {
            $users = DB::table('user_team as ut')
                ->where('ut.user_id', '=', $userTeam->getUserId())
                ->where('ut.team_id', '=', $userTeam->getTeamId())
                ->where('ut.user_accepted', '=', true)
                ->where('ut.team_accepted', '=', true)
                ->exists();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}