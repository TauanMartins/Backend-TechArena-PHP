<?php

namespace TechArena\Funcionalities\Friend\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use TechArena\Funcionalities\Friend\Infra\Model\Friend;
use TechArena\Funcionalities\Friend\Infra\Interfaces\FriendInterface as Base;
use TechArena\Funcionalities\User\Infra\Model\User;

class FriendRepository implements Base
{

    public function selectAll(User $user): array
    {
        try {
            $userId = $user->getId();
            $friends = DB::table('friend')
                ->join('user as u', function ($join) use ($userId) {
                    $join->on('friend.user_1_id', '=', 'u.id')
                        ->orOn('friend.user_2_id', '=', 'u.id');
                })
                ->where(function ($query) use ($userId) {
                    $query->where('friend.user_1_id', $userId)
                        ->orWhere('friend.user_2_id', $userId);
                })
                ->where('friend.user_1_accepted', true)
                ->where('friend.user_2_accepted', true)
                ->where('u.id', '<>', $userId)
                ->select('u.id', 'u.image', 'u.name', 'u.username')
                ->get()
                ->toArray();
            return $friends;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectRequested(User $user): array
    {
        try {
            $userId = $user->getId();
            $friendRequests = DB::table('friend')
                ->join('user as u', 'friend.user_2_id', '=', 'u.id')
                ->where('friend.user_1_id', '=', $userId)
                ->where('friend.user_2_accepted', '=', false) // Excluir os aceitos
                ->select('u.id', 'u.image', 'u.name', 'u.username', 'friend.user_2_accepted as accepted')
                ->get()
                ->toArray();
            return $friendRequests;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectReceived(User $user): array
    {
        try {
            $userId = $user->getId();
            $friendRequestsReceived = DB::table('friend')
                ->join('user as u', 'friend.user_1_id', '=', 'u.id')
                ->where('friend.user_2_id', '=', $userId)
                ->where('friend.user_2_accepted', '=', false) 
                ->select('u.id', 'u.image', 'u.name', 'u.username', 'friend.user_2_accepted as accepted')
                ->get()
                ->toArray();
            return $friendRequestsReceived;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(Friend $friend): void
    {
        try {
            DB::table('friend')->insert($friend->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(Friend $friend)
    {
        try {
            DB::table('friend')
            ->where('user_1_id', '=', $friend->getUser1Id())
            ->where('user_2_id', '=', $friend->getUser2Id())
            ->update($friend->toArray());
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
    public function exist(Friend $friend): bool
    {
        try {
            return DB::table('friend')
                ->where(function ($query) use ($friend) {
                    $query->where('user_1_id', $friend->getUser1Id())
                        ->where('user_2_id', $friend->getUser2Id());
                })
                ->orWhere(function ($query) use ($friend) {
                    $query->where('user_1_id', $friend->getUser2Id())
                        ->where('user_2_id', $friend->getUser1Id());
                })
                ->exists();
            ;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}