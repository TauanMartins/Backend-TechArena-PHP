<?php

namespace TechArena\Funcionalities\Arenas\Infra\Model;

use Illuminate\Contracts\Support\Arrayable;

class Arena implements Arrayable
{
    private null|int $id;
    private string $address;
    private float $lat;
    private float $longitude;
    private ?string $image;
    private bool $is_league_only;

    public function __construct(
        string $address,
        float $lat,
        float $longitude,
        ?string $image,
        bool $is_league_only,
    ) {
        $this->id = null;
        $this->address = $address;
        $this->lat = $lat;
        $this->longitude = $longitude;
        $this->image = $image;
        $this->is_league_only = $is_league_only;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): null|int
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function is_league_only(): bool
    {
        return $this->is_league_only;
    }

    public function toArray(): array
    {
        return [
            'address' => $this->address,
            'lat' => $this->lat,
            'longitude' => $this->longitude,
            'image' => $this->image,
            'is_league_only' => $this->is_league_only,
        ];
    }

    public static function fromArray(array $data): self
    {
        $arena = new self(
            $data['address'],
            $data['lat'],
            $data['longitude'],
            $data['image'] ?? null,
            $data['is_league_only']
        );
        if (isset($data['id'])) {
            $arena->setId($data['id']);
        }
        return $arena;
    }
}
