<?php

namespace TechArena\Funcionalities\Arena\Infra\Interfaces;

use TechArena\Funcionalities\Arena\Infra\Model\Arena;

interface ArenaInterface
{
    public function selectAll(): array;
    public function selectByFilters(string $lat, string $longitude): array;
    public function selectBySport(int $sport_id): array;
    public function selectSpecificBySport(int $sport_id, int $arena_id): int;
    public function select(int $id): Arena;
    public function create(Arena $arena);
    public function update(Arena $arena);
    public function delete(Arena $arena);
    public function exist(Arena $arena);

}