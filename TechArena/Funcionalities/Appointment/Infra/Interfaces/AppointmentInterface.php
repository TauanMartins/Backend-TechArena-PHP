<?php

namespace TechArena\Funcionalities\Appointment\Infra\Interfaces;

use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\User\Infra\Model\User;

interface AppointmentInterface
{
    public function select(User $user, string $lat, string $longitude, string|null $cursor): array;
    public function selectAll(User $user, string $lat, string $longitude, string|null $cursor): array;
    public function selectById(int $id): Appointment;    
    public function create(Appointment $appointment): void;

}