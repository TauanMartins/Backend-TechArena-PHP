<?php

namespace TechArena\Funcionalities\SportPrefered\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\SportPrefered\Infra\Interfaces\SportPreferedInterface as Base;
use TechArena\Funcionalities\SportPrefered\Infra\Model\SportPrefered;
use TechArena\Funcionalities\User\Infra\Model\User;

class SportPreferedRepository implements Base
{

    public function selectAll(User $user): array
    {
        try {
            $prefered_sports = DB::table('prefered_sports', 'ps')
                ->select('s.*')
                ->join('sport as s', 'ps.sport_id', '=', 's.id')
                ->where('ps.user_id', '=', $user->getId())
                ->get()
                ->toArray();
            return $prefered_sports;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(SportPrefered $sportPrefered): void
    {
        try {
            DB::table('prefered_sports')->insert($sportPrefered->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update(SportPrefered $sportPrefered): void
    {
        try {
            DB::table('prefered_sports')->get()->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function removeAll(User $user): void
    {
        try {
            DB::table('prefered_sports')->where('user_id', '=', $user->getId())->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function allowed(User $user): bool
    {
        try {
            $result = DB::table('prefered_sports')
                ->where('user_id', '=', $user->getId())
                ->count('*');

            if ($result >= 4) {
                return false;
            }

            // Continue com a execução ou retorne true
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}