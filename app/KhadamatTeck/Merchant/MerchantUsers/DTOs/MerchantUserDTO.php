<?php

namespace App\KhadamatTeck\Merchant\MerchantUsers\DTOs;

class MerchantUserDTO implements \JsonSerializable
{
            private ?int $id= null;
            private ?string $name= null;
            private ?int $merchant_id= null;
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
    public function getMerchantId(): ?int
    {
        return $this->merchant_id;
    }

/**
     * @param int|null $merchant_id
     */
    public function setMerchantId(?int $merchant_id): void
    {
        $this->merchant_id = $merchant_id;
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
            'merchant_id'=>$this->getMerchantId(),
            'email'=>$this->getEmail(),
            'address'=>$this->getAddress(),
            'phone'=>$this->getPhone(),
            'role'=>$this->getRole(),
            'password'=>$this->getPassword(),
            'status'=>$this->getStatus(),

        ];
    }
}
