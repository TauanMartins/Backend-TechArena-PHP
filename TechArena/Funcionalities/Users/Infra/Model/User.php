<?php

namespace TechArena\Funcionalities\Users\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class User implements Arrayable
{
    private null|int $id;
    private string $name;
    private null|string $username;
    private string $image;
    private string $email;
    private DateTime $dt_birth; // Adjusted data type to DateTime
    private string $gender;
    private DateTime $created_at; // Fixed Date to DateTime

    public function __construct(
        string $name,
        null|string $username,
        string $image,
        string $email,
        DateTime $dt_birth,
        string $gender
    ) {
        $this->id = null;
        $this->name = $name;
        $this->username = $username;
        $this->image = $image;
        $this->email = $email;
        $this->dt_birth = $dt_birth;
        $this->gender = $gender;
        $this->created_at = new DateTime();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): null|int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): null|string
    {
        return $this->username;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDtBirth(): DateTime
    {
        return $this->dt_birth;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'email' => $this->email,
            'dt_birth' => $this->dt_birth->format('Y-m-d'),
            'gender' => $this->gender,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new User(
            $data['name'],
            $data['username'],
            $data['image'],
            $data['email'],
            DateTime::createFromFormat('Y-m-d', $data['dt_birth']),
            $data['gender']
        );
    }
}
