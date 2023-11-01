<?php

namespace TechArena\Funcionalities\UserPreferences\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class UserPreference implements Arrayable
{
    private int $user_id;
    private int $preference_id;
    private string $desc_preference; 
    private string|null $value; 

    public function __construct(
        int $user_id,        
        int $preference_id,
        string $desc_preference,
        string|null $value,
    ) {
        $this->user_id = $user_id;
        $this->preference_id = $preference_id;
        $this->desc_preference = $desc_preference;
        $this->value = $value;
    }

    public function setIdUser(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getIdUser(): int
    {
        return $this->user_id;
    }
    public function setIdPreference(int $preference_id): void
    {
        $this->preference_id = $preference_id;
    }
    public function getIdPreference(): int
    {
        return $this->preference_id;
    }

    public function getDescPreference(): string
    {
        return $this->desc_preference;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'preference_id' => $this->preference_id,
            'desc_preference' => $this->desc_preference,
            'value' => $this->value,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new UserPreference(
            $data['user_id'],
            $data['preference_id'],
            $data['desc_preference'],
            $data['value']
        );
    }
}
