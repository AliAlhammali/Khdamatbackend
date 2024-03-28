<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\DTOs;

class ServiceProviderUserDTO implements \JsonSerializable
{
            private ?int $id= null;
            private ?string $name= null;
            private ?int $service_provider_id= null;
            private ?string $email= null;
            private ?string $address= null;
            private ?string $phone= null;
            private ?string $role= null;
            private ?string $password= null;
            private ?string $status= null;


/**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

/**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }/**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

/**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }/**
     * @return int|null
     */
    public function getServiceProviderId(): ?int
    {
        return $this->service_provider_id;
    }

/**
     * @param int|null $service_provider_id
     */
    public function setServiceProviderId(?int $service_provider_id): void
    {
        $this->service_provider_id = $service_provider_id;
    }/**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

/**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }/**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

/**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }/**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

/**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }/**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

/**
     * @param string|null $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }/**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

/**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }/**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

/**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function jsonSerialize()
    {
        return [
                        'id'=>$this->getId(),
            'name'=>$this->getName(),
            'service_provider_id'=>$this->getServiceProviderId(),
            'email'=>$this->getEmail(),
            'address'=>$this->getAddress(),
            'phone'=>$this->getPhone(),
            'role'=>$this->getRole(),
            'password'=>$this->getPassword(),
            'status'=>$this->getStatus(),

        ];
    }
}
