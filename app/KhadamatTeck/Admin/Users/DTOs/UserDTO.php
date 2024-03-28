<?php

namespace App\KhadamatTeck\Admin\Users\DTOs;

class UserDTO implements \JsonSerializable
{
            private string $id;
            private string $name;
            private string $email;
            private string $password;
            private string $email_verified_at;


/**
     * @return string|null
     */
    public function getId(): string
    {
        return $this->id;
    }

/**
     * @param string|null $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }/**
     * @return string|null
     */
    public function getName(): string
    {
        return $this->name;
    }

/**
     * @param string|null $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }/**
     * @return string|null
     */
    public function getEmail(): string
    {
        return $this->email;
    }

/**
     * @param string|null $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }/**
     * @return string|null
     */
    public function getPassword(): string
    {
        return $this->password;
    }

/**
     * @param string|null $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }/**
     * @return string|null
     */
    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }

/**
     * @param string|null $email_verified_at
     */
    public function setEmailVerifiedAt(string $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    public function jsonSerialize()
    {
        return [
                        'id'=>$this->getId(),
            'name'=>$this->getName(),
            'email'=>$this->getEmail(),
            'password'=>$this->getPassword(),
            'email_verified_at'=>$this->getEmailVerifiedAt(),

        ];
    }
}
