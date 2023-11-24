<?php

namespace TechArena\Funcionalities\UserAppointment\Infra\Interfaces;

use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;

interface UserAppointmentInterface
{
    public function select(): array;
    public function selectAll(): array;
    public function create(UserAppointment $userAppointment): void;    
    public function allowedUserInAppointment(UserAppointment $userAppointment): bool;

}