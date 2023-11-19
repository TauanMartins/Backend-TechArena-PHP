<?php

namespace TechArena\Funcionalities\Team\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface as Base;
use TechArena\Funcionalities\Team\Infra\Model\Team;

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
    public function selectById(int $id): Team
    {
        try {
            $teamData = DB::table('team', 't')
                ->where('t.id', '=', $id)
                ->first();
            if (!$teamData) {
                throw new Exception('Usuário não encontrado.');
            }
            $team = new Team($teamData->name, $teamData->description, $teamData->image, $teamData->chat_id);
            $team->setId($teamData->id);
            $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $teamData->created_at);
            $team->setCreatedAt($createdAt);
            
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
    }
    public function delete(Team $team)
    {
    }
    public function exist(Team $team)
    {
        return DB::table('team', 't')
            ->where('t.name', '=', $team->getName())
            ->exists();
    }
}