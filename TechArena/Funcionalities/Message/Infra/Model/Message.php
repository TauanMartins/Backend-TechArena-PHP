<?php

namespace TechArena\Funcionalities\Message\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Message implements Arrayable
{
    private null|int $id;
    private string $message;
    private DateTime $created_at;
    private int $chat_id;
    private int $user_id;
    public function __construct(
        string $message,
        int $chat_id,
        int $user_id
    ) {
        $this->id = null;
        $this->message = $message;
        $this->created_at = new DateTime();
        $this->chat_id = $chat_id;
        $this->user_id = $user_id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function getChatId(): int
    {
        return $this->chat_id;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id
        ];
    }
    public function toArrayToInsert(): array
    {
        return [
            'message' => $this->message,
            'created_at' => $this->created_at,
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['message'],
            $data['chat_id'],
            $data['user_id']
        );
    }
}
