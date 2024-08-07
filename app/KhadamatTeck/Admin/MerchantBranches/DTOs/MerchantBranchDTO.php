<?php

namespace App\KhadamatTeck\Admin\MerchantBranches\DTOs;

class MerchantBranchDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?array $location = null;
    private ?string $name = null;
    private ?int $merchant_id = null;
    private ?string $address = null;
    private ?bool $is_active = null;


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
    }

    /**
     * @return array|null
     */
    public function getLocation(): ?array
    {
        return $this->location;
    }

    /**
     * @param array|null $location
     */
    public function setLocation(?array $location): void
    {
        $this->location = $location;
    }

    /**
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
    }

    /**
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
    }

    /**
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
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool|null $is_active
     */
    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'location' => $this->getLocation(),
            'name' => $this->getName(),
            'merchant_id' => $this->getMerchantId(),
            'address' => $this->getAddress(),
            'is_active' => $this->getIsActive(),

        ];
    }
}
