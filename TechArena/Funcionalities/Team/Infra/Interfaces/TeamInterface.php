<?php

namespace TechArena\Funcionalities\Team\Infra\Interfaces;
use TechArena\Funcionalities\Team\Infra\Model\Team;

interface TeamInterface
{
    public function select();
    public function selectById(int $id): Team;
    public function create(Team $team);
    public function update(Team $team);
    public function delete(Team $team);
    public function exist(Team $team);

}