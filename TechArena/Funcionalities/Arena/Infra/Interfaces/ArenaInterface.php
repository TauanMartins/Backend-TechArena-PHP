<?php

namespace TechArena\Funcionalities\Arena\Infra\Interfaces;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;

interface ArenaInterface
{
    public function selectByFilters(array $filters): array;
    public function create(Arena $arena);
    public function update(Arena $arena);
    public function delete(Arena $arena);
    public function exist(Arena $arena);

}