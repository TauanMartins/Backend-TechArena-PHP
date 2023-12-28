<?php

namespace TechArena\Funcionalities\Team\Infra\Interfaces;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;

interface TeamInterface
{
    public function select();
    public function selectAllByName(string $name): array;
    public function selectById(int $id): Team;
    public function create(Team $team);
    public function update(Team $team);
    public function delete(Team $team);
    public function exist(string $name): bool;

}