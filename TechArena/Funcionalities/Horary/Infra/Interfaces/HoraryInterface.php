<?php

namespace TechArena\Funcionalities\Horary\Infra\Interfaces;

use DateTime;

interface HoraryInterface
{
    public function select(int $sport_id, int $arena_id, DateTime $date): array;

}