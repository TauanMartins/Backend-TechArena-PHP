<?php

namespace TechArena\Funcionalities\Arenas\Infra\Interfaces;
use TechArena\Funcionalities\Arenas\Infra\Model\Arena;

interface ArenasInterface
{
    public function selectByFilters(array $filters): array;
    public function create(Arena $arena);
    public function update(Arena $arena);
    public function delete(Arena $arena);
    public function exist(Arena $arena);

}