<?php

namespace TechArena\Funcionalities\Permission\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class Permission implements Arrayable
{
    private int $id;
    private string $symbol;
    private string $slug;

    public function __construct(
        int $id,
        string $symbol,
        string $slug,
    ) {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->slug = $slug;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'symbol' => $this->symbol,
            'slug' => $this->slug,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new Permission(
            $data['id'],
            $data['symbol'],
            $data['slug'],
        );
    }
}
