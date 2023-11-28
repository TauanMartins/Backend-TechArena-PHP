<?php

namespace TechArena\Funcionalities\SportArena\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class SportArena implements Arrayable
{
    private null|int $id;
    private int $sport_id;
    private int $arena_id;

    public function __construct(
        int $sport_id,
        int $arena_id,
    ) {
        $this->id = null;
        $this->sport_id = $sport_id;
        $this->arena_id = $arena_id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): null|int
    {
        return $this->id;
    }

    public function getSportId(): int
    {
        return $this->sport_id;
    }
    public function getArenaId(): int
    {
        return $this->arena_id;
    }


    public function toArray(): array
    {
        return [
            'sport_id' => $this->sport_id,
            'arena_id' => $this->arena_id,
        ];
    }

    public static function fromArray(array $data): self
    {
        $arena = new self(
            $data['sport_id'],
            $data['arena_id'],
        );
        return $arena;
    }
}
