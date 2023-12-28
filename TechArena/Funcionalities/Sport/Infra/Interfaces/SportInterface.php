<?php

namespace TechArena\Funcionalities\Sport\Infra\Interfaces;

interface SportInterface
{
    public function selectAll(): array;
    public function selectSportMaterialAll(int $sport_id): array;

}