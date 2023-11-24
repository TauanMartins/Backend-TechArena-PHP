<?php

namespace TechArena\Funcionalities\Sport\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Sport implements Arrayable
{
    private int $id;
    private string $name;
    private int $default_number_players;

    public function __construct(
        int $id,
        string $name,
        int $default_number_players,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->default_number_players = $default_number_players;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefaultPlayer(): int
    {
        return $this->default_number_players;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'default_number_players' => $this->default_number_players,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['default_value_player_numbers']
        );
    }
}
