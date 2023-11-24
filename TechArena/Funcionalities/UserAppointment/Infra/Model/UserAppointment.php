<?php

namespace TechArena\Funcionalities\UserAppointment\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class UserAppointment implements Arrayable
{
    private int $appointment_id;
    private int $user_id;
    private bool $holder;

    public function __construct(
        int $appointment_id,
        int $user_id,
        bool $holder,
    ) {
        $this->appointment_id = $appointment_id;
        $this->user_id = $user_id;
        $this->holder = $holder;
    }
    public function getAppointmentId(): int
    {
        return $this->appointment_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getHolder(): bool
    {
        return $this->holder;
    }

    public function toArray(): array
    {
        return [
            'appointment_id' => $this->appointment_id,
            'user_id' => $this->user_id,
            'holder' => $this->holder,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['appointment_id'],
            $data['user_id'],
            $data['holder'],
        );
    }
}
