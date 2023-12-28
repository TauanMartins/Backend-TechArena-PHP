<?php

namespace TechArena\Funcionalities\Chat\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Chat implements Arrayable
{
    private null|int $id;
    private null|int $last_message_id;
    private DateTime $created_at;
    private null|bool $is_group_chat;

    public function __construct()
    {
        $this->id = null;
        $this->last_message_id = null;
        $this->created_at = new DateTime();
        $this->is_group_chat = null;        
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setIsGroupChat(bool $is_group_chat): void
    {
        $this->is_group_chat = $is_group_chat;
    }
    public function setLastMessageId(int $last_message_id): void
    {
        $this->last_message_id = $last_message_id;
    }
    public function getLastMessageId(): null|int
    {
        return $this->last_message_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function getIsGroupChat(): bool
    {
        return $this->is_group_chat;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'last_message_id' => $this->last_message_id,
            'created_at' => $this->created_at,
            'is_group_chat'=> $this->is_group_chat
        ];
    }
    public function toArrayInsert(): array
    {
        return [
            'created_at' => $this->created_at,
            'is_group_chat'=> $this->is_group_chat
        ];
    }

    public static function fromArray(): self
    {
        return new self();
    }
}
