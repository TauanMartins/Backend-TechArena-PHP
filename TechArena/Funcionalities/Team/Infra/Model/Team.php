<?php

namespace TechArena\Funcionalities\Team\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Team implements Arrayable
{
    private null|int $id;
    private string $name;
    private string $description;
    private string $image;
    private DateTime $created_at;
    private int $chat_id;

    public function __construct(
        string $name,
        string $description,
        string $image,
        int $chat_id
    ) {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->chat_id = $chat_id;
        $this->created_at = new DateTime();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }
    public function getId(): null|int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function getImage(): string
    {
        return $this->image;
    }

    public function getChatId(): int
    {
        return $this->chat_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),            
            'chat_id' => $this->chat_id,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['image'],
            $data['chat_id']
        );
    }
}
