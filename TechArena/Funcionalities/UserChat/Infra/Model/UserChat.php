<?php

namespace TechArena\Funcionalities\UserChat\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class UserChat implements Arrayable
{
    private int $chatId;
    private int $userId;

    public function __construct(
        int $chatId,
        int $userId
    ) {
        $this->chatId = $chatId;
        $this->userId = $userId;
    }
    public function getChatId(): int
    {
        return $this->chatId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function toArray(): array
    {
        return [
            'chat_id' => $this->chatId,
            'user_id' => $this->userId
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self($data['chat_id'], $data['user_id']);
    }
}
