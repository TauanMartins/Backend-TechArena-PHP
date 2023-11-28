<?php

namespace TechArena\Funcionalities\SportArena\Infra\Interfaces;

use TechArena\Funcionalities\Arena\Infra\Model\Arena;
use TechArena\Funcionalities\SportArena\Infra\Model\SportArena;

interface SportArenaInterface
{
    public function select(int $arena_id): array;
    public function create(SportArena $sport_arena);
    public function delete(Arena $arena);
    public function exist(Arena $arena, int $sport_id);

}