<?php

namespace TechArena\Funcionalities\Chat\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Chat implements Arrayable
{
    private int $id;
    private null|int $last_message_id;
    private DateTime $created_at; 

    public function __construct(
        int $id,
        ?int $last_message_id,
    ) {
        $this->id = $id;
        $this->last_message_id = $last_message_id;        
        $this->created_at = new DateTime();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getLastMessageId(): null|int
    {
        return $this->last_message_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'last_message_id' => $this->last_message_id,
            'created_at' => $this->created_at
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['last_message_id']
        );
    }
}
