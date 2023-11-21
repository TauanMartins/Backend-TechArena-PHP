<?php

namespace TechArena\Funcionalities\Team\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface as Base;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;

class TeamRepository implements Base
{

    public function select()
    {
        try {
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllByName(string $name): array
    {
        try {
            $teams = DB::table('team as t')
                ->select('t.id', DB::raw('t.name || \' - \'|| u.username as name'), 't.description', 't.image')
                ->join('user_team as ut', 'ut.team_id', '=', 't.id')
                ->join('user as u', 'ut.user_id', '=', 'u.id')
                ->where('ut.leader', '=', true)
                ->whereRaw('LOWER(t.name) LIKE ?', ['%' . strtolower($name) . '%'])
                ->get()
                ->toArray();
            return $teams;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectById(int $id): Team
    {
        try {
            $teamData = DB::table('team', 't')
                ->where('t.id', '=', $id)
                ->first();
            if (!$teamData) {
                throw new Exception('Time não encontrado.');
            }
            $team = new Team($teamData->name, $teamData->description, $teamData->image);
            $team->setId($teamData->id);
            $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $teamData->created_at);
            $team->setCreatedAt($createdAt);
            $team->setChatId($teamData->chat_id);

            return $team;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(Team $team)
    {
        try {
            $id = DB::table('team')->insertGetId($team->toArray());
            $team->setId($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    public function update(Team $team)
    {
        try {
            DB::table("team", 't')
                ->where(['t.id' => $team->getId()])
                ->update([
                    'name' => $team->getName(),
                    'description' => $team->getDescription(),
                    'image' => $team->getImage()
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function delete(Team $team)
    {
    }
    public function exist(string $name): bool
    {
        $exists = DB::table('team', 't')
            ->whereRaw('LOWER(t.name) = ?', strtolower($name))
            ->exists();
        if ($exists) {
            throw new Exception('Um time com este nome já existe.');
        }
        return $exists;
    }
}