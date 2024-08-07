<?php

namespace App\KhadamatTeck\Admin\OrderItems\DTOs;

class OrderItemDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?string $order_id = null;
    private ?string $item_id = null;
    private ?float $quantity = 0;
    private ?float $item_price = 0;
    private ?float $sup_total = 0;
    private ?float $vat = 0;
    private ?float $total = 0;
    private ?float $order_otp = null;
    private ?float $sp_item_price = 0;
    private ?float $sp_sup_total = 0;
    private ?float $sp_vat = 0;
    private ?float $sp_total = 0;


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
    public function getItemId(): ?string
    {
        return $this->item_id;
    }

    /**
     * @param string|null $item_id
     */
    public function setItemId(?string $item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @param float|null $quantity
     */
    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float|null
     */
    public function getItemPrice(): ?float
    {
        return $this->item_price;
    }

    /**
     * @param float|null $item_price
     */
    public function setItemPrice(?float $item_price): void
    {
        $this->item_price = $item_price;
    }

    /**
     * @return float|null
     */
    public function getSupTotal(): ?float
    {
        return $this->sup_total;
    }

    /**
     * @param float|null $sup_total
     */
    public function setSupTotal(?float $sup_total): void
    {
        $this->sup_total = $sup_total;
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
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float|null $total
     */
    public function setTotal(?float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return float|null
     */
    public function getOrderOtp(): ?float
    {
        return $this->order_otp;
    }

    /**
     * @param float|null $order_otp
     */
    public function setOrderOtp(?float $order_otp): void
    {
        $this->order_otp = $order_otp;
    }

    public function getSpItemPrice(): ?float
    {
        return $this->sp_item_price;
    }

    public function setSpItemPrice(?float $sp_item_price): void
    {
        $this->sp_item_price = $sp_item_price;
    }

    public function getSpSupTotal(): ?float
    {
        return $this->sp_sup_total;
    }

    public function setSpSupTotal(?float $sp_sup_total): void
    {
        $this->sp_sup_total = $sp_sup_total;
    }

    public function getSpVat(): ?float
    {
        return $this->sp_vat;
    }

    public function setSpVat(?float $sp_vat): void
    {
        $this->sp_vat = $sp_vat;
    }

    public function getSpTotal(): ?float
    {
        return $this->sp_total;
    }

    public function setSpTotal(?float $sp_total): void
    {
        $this->sp_total = $sp_total;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'order_id' => $this->getOrderId(),
            'item_id' => $this->getItemId(),
            'quantity' => $this->getQuantity(),
            'item_price' => $this->getItemPrice(),
            'sup_total' => $this->getSupTotal(),
            'vat' => $this->getVat(),
            'total' => $this->getTotal(),
            'sp_item_price' => $this->getSpItemPrice(),
            'sp_sup_total' => $this->getSpSupTotal(),
            'sp_vat' => $this->getSpVat(),
            'sp_total' => $this->getSpTotal(),
            'order_otp' => $this->getOrderOtp(),

        ];
    }
}
