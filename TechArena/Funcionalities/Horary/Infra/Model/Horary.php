<?php

namespace TechArena\Funcionalities\Horary\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Horary implements Arrayable
{
    private int|null $id;
    private DateTime $date;
    private int $sport_arena_id;
    private int $schedule_id;
    private int $organizer_id;
    private int|null $chat_id;

    public function __construct(
        DateTime $date,
        int $sport_arena_id,
        int $schedule_id,
        int $organizer_id,
    ) {
        $this->id = null;
        $this->date = $date;
        $this->sport_arena_id = $sport_arena_id;
        $this->schedule_id = $schedule_id;
        $this->organizer_id = $organizer_id;
        $this->chat_id = null;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setChatId(int $chat_id): void
    {
        $this->chat_id = $chat_id;
    }
    public function getId(): null|int
    {
        return $this->id;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
    public function getSportArenaId(): int
    {
        return $this->sport_arena_id;
    }

    public function getScheduleId(): int
    {
        return $this->schedule_id;
    }
    public function getOrganizerId(): int
    {
        return $this->organizer_id;
    }
    public function getChatId(): int
    {
        return $this->chat_id;
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date->format('Y-m-d'),
            'sport_arena_id' => $this->sport_arena_id,
            'schedule_id' => $this->schedule_id,
            'organizer_id' => $this->organizer_id,
            'chat_id' => $this->chat_id,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            DateTime::createFromFormat('Y-m-d', $data['date']),
            $data['sport_arena_id'],
            $data['schedule_id'],
            $data['organizer_id'],
        );
    }
}
