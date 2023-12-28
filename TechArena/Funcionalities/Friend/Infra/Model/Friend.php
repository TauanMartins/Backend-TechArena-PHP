<?php

namespace TechArena\Funcionalities\Friend\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Friend implements Arrayable
{
    private null|int $id;
    private int $user_1_id;
    private int $user_2_id;
    private bool $user_1_accepted;
    private bool $user_2_accepted;
    public function __construct(
        int $user_1_id,
        int $user_2_id,
        bool $user_1_accepted,
        bool $user_2_accepted
    ) {
        $this->id = null;
        $this->user_1_id = $user_1_id;
        $this->user_2_id = $user_2_id;
        $this->user_1_accepted = $user_1_accepted;
        $this->user_2_accepted = $user_2_accepted;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getUser1Id(): int
    {
        return $this->user_1_id;
    }

    public function getUser2Id(): int
    {
        return $this->user_2_id;
    }

    public function getUser1Accepted(): bool
    {
        return $this->user_1_accepted;
    }

    public function getUser2Accepted(): bool
    {
        return $this->user_2_accepted;
    }

    public function toArray(): array
    {
        return [
            'user_1_id' => $this->user_1_id,
            'user_2_id' => $this->user_2_id,
            'user_1_accepted' => $this->user_1_accepted,
            'user_2_accepted' => $this->user_2_accepted
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_1_id'],
            $data['user_2_id'],
            $data['user_1_accepted'],
            $data['user_2_accepted']
        );
    }
}