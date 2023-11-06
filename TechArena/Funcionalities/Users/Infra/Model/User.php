<?php

namespace TechArena\Funcionalities\Users\Infra\Model;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class User implements Arrayable
{
    private null|int $id;
    private string $name;
    private string $username;
    private string $image;
    private string $email;
    private DateTime $dt_birth; 
    private string $gender;
    private DateTime $created_at; 
    private int $permission_id;

    public function __construct(
        string $name,
        string $username,
        string $image,
        string $email,
        DateTime $dt_birth,
        string $gender,
        int $permission_id
    ) {
        $this->id = null;
        $this->name = $name;
        $this->username = $username;
        $this->image = $image;
        $this->email = $email;
        $this->dt_birth = $dt_birth;
        $this->gender = $gender;
        $this->permission_id = $permission_id;
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

    public function getUsername(): string
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
    public function getPermission(): int
    {
        return $this->permission;
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
            'permission_id' => $this->permission,
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
            $data['gender'],
            $data['permission_id']
        );
    }
}
