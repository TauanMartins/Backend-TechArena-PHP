<?php

namespace TechArena\Funcionalities\Preferences\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class Preferences implements Arrayable
{
    private int $preference_id;
    private string $desc_preference;
    private ?string $default_value;

    public function __construct(
        int $preference_id,
        string $desc_preference,
        ?string $default_value,
    ) {
        $this->preference_id = $preference_id;
        $this->desc_preference = $desc_preference;
        $this->default_value = $default_value;
    }
    public function getIdPreference(): int
    {
        return $this->preference_id;
    }

    public function getDescPreference(): string
    {
        return $this->desc_preference;
    }

    public function getDefaultValue(): string
    {
        return $this->default_value;
    }

    public function toArray(): array
    {
        return [
            'preference_id' => $this->preference_id,
            'desc_preference' => $this->desc_preference,
            'default_value' => $this->default_value,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new Preferences(
            $data['id'],
            $data['desc_preference'],
            $data['default_value']
        );
    }
}
