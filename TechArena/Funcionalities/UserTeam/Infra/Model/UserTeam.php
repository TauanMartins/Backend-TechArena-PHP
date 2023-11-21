<?php

namespace TechArena\Funcionalities\UserTeam\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class UserTeam implements Arrayable
{
    private int $user_id;
    private int $team_id;
    private bool $user_accepted;
    private bool $team_accepted;
    private bool $leader;
    public function __construct(
        int $user_id,
        int $team_id,
        bool $user_accepted,
        bool $team_accepted
    ) {
        $this->user_id = $user_id;
        $this->team_id = $team_id;
        $this->user_accepted = $user_accepted;
        $this->team_accepted = $team_accepted;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getTeamId(): int
    {
        return $this->team_id;
    }

    public function getUserAccepted(): bool
    {
        return $this->user_accepted;
    }

    public function getTeamAccepted(): bool
    {
        return $this->team_accepted;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'team_id' => $this->team_id,
            'user_accepted' => $this->user_accepted,
            'team_accepted' => $this->team_accepted
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['team_id'],
            $data['user_accepted'],
            $data['team_accepted']
        );
    }
}