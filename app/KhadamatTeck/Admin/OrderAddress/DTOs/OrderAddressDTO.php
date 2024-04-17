<?php

namespace App\KhadamatTeck\Admin\OrderAddress\DTOs;

class OrderAddressDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?string $order_id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phone = null;
    private ?string $address = null;
    private ?float $vat = null;
    private ?array $location = null;
    private ?array $pick_up_location = null;
    private ?bool $is_default_address = null;


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
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    /**
     * @param string|null $order_id
     */
    public function setOrderId(?string $order_id): void
    {
        $this->order_id = $order_id;
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
    }

    /**
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
     * @return float|null
     */
    public function getVat(): ?float
    {
        return $this->vat;
    }

    /**
     * @param float|null $vat
     */
    public function setVat(?float $vat): void
    {
        $this->vat = $vat;
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
     * @return array|null
     */
    public function getPickUpLocation(): ?array
    {
        return $this->pick_up_location;
    }

    /**
     * @param array|null $pick_up_location
     */
    public function setPickUpLocation(?array $pick_up_location): void
    {
        $this->pick_up_location = $pick_up_location;
    }

    /**
     * @return bool|null
     */
    public function getIsDefaultAddress(): ?bool
    {
        return $this->is_default_address;
    }

    /**
     * @param bool|null $is_default_address
     */
    public function setIsDefaultAddress(?bool $is_default_address): void
    {
        $this->is_default_address = $is_default_address;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'order_id' => $this->getOrderId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'vat' => $this->getVat(),
            'location' => $this->getLocation(),
            'pick_up_location' => $this->getPickUpLocation(),
            'is_default_address' => $this->getIsDefaultAddress(),

        ];
    }
}
