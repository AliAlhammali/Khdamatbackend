<?php

namespace App\KhadamatTeck\Admin\Users\DTOs;

class UserDTO implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private ?string $email_verified_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(?string $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'email_verified_at' => $this->getEmailVerifiedAt(),

        ];
    }
}
