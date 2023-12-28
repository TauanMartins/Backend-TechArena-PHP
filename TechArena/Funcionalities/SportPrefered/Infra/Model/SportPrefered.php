<?php

namespace TechArena\Funcionalities\SportPrefered\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class SportPrefered implements Arrayable
{
    private int $user_id;
    private int $sport_id;

    public function __construct(
        int $user_id,
        int $sport_id,
    ) {
        $this->user_id = $user_id;
        $this->sport_id = $sport_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getSportId(): int
    {
        return $this->sport_id;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'sport_id' => $this->sport_id
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['sport_id']
        );
    }
}
