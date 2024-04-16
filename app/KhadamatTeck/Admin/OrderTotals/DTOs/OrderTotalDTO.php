<?php

namespace App\KhadamatTeck\Admin\OrderTotals\DTOs;

class OrderTotalDTO implements \JsonSerializable
{
            private ?int $id= null;
            private ?string $order_id= null;
            private ?string $merchant_id= null;
            private ?string $merchant_user_id= null;
            private ?string $item_id= null;
            private ?float $quantity= null;
            private ?float $item_price= null;
            private ?float $order_otp= null;
            private ?float $merchant_user_commission_total= null;
            private ?float $merchant_user_commission_sup_total= null;
            private ?float $merchant_user_commission_vat= null;
            private ?float $sp_total= null;
            private ?float $sp_sup_total= null;
            private ?float $sp_vat= null;
            private ?float $sup_total= null;
            private ?float $vat= null;
            private ?float $total= null;


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
    }/**
     * @return string|null
     */
    public function getMerchantId(): ?string
    {
        return $this->merchant_id;
    }

/**
     * @param string|null $merchant_id
     */
    public function setMerchantId(?string $merchant_id): void
    {
        $this->merchant_id = $merchant_id;
    }/**
     * @return string|null
     */
    public function getMerchantUserId(): ?string
    {
        return $this->merchant_user_id;
    }

/**
     * @param string|null $merchant_user_id
     */
    public function setMerchantUserId(?string $merchant_user_id): void
    {
        $this->merchant_user_id = $merchant_user_id;
    }/**
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
    }/**
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
    }/**
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
    }/**
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
    }/**
     * @return float|null
     */
    public function getMerchantUserCommissionTotal(): ?float
    {
        return $this->merchant_user_commission_total;
    }

/**
     * @param float|null $merchant_user_commission_total
     */
    public function setMerchantUserCommissionTotal(?float $merchant_user_commission_total): void
    {
        $this->merchant_user_commission_total = $merchant_user_commission_total;
    }/**
     * @return float|null
     */
    public function getMerchantUserCommissionSupTotal(): ?float
    {
        return $this->merchant_user_commission_sup_total;
    }

/**
     * @param float|null $merchant_user_commission_sup_total
     */
    public function setMerchantUserCommissionSupTotal(?float $merchant_user_commission_sup_total): void
    {
        $this->merchant_user_commission_sup_total = $merchant_user_commission_sup_total;
    }/**
     * @return float|null
     */
    public function getMerchantUserCommissionVat(): ?float
    {
        return $this->merchant_user_commission_vat;
    }

/**
     * @param float|null $merchant_user_commission_vat
     */
    public function setMerchantUserCommissionVat(?float $merchant_user_commission_vat): void
    {
        $this->merchant_user_commission_vat = $merchant_user_commission_vat;
    }/**
     * @return float|null
     */
    public function getSpTotal(): ?float
    {
        return $this->sp_total;
    }

/**
     * @param float|null $sp_total
     */
    public function setSpTotal(?float $sp_total): void
    {
        $this->sp_total = $sp_total;
    }/**
     * @return float|null
     */
    public function getSpSupTotal(): ?float
    {
        return $this->sp_sup_total;
    }

/**
     * @param float|null $sp_sup_total
     */
    public function setSpSupTotal(?float $sp_sup_total): void
    {
        $this->sp_sup_total = $sp_sup_total;
    }/**
     * @return float|null
     */
    public function getSpVat(): ?float
    {
        return $this->sp_vat;
    }

/**
     * @param float|null $sp_vat
     */
    public function setSpVat(?float $sp_vat): void
    {
        $this->sp_vat = $sp_vat;
    }/**
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
    }/**
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
    }/**
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

    public function jsonSerialize()
    {
        return [
                        'id'=>$this->getId(),
            'order_id'=>$this->getOrderId(),
            'merchant_id'=>$this->getMerchantId(),
            'merchant_user_id'=>$this->getMerchantUserId(),
            'item_id'=>$this->getItemId(),
            'quantity'=>$this->getQuantity(),
            'item_price'=>$this->getItemPrice(),
            'order_otp'=>$this->getOrderOtp(),
            'merchant_user_commission_total'=>$this->getMerchantUserCommissionTotal(),
            'merchant_user_commission_sup_total'=>$this->getMerchantUserCommissionSupTotal(),
            'merchant_user_commission_vat'=>$this->getMerchantUserCommissionVat(),
            'sp_total'=>$this->getSpTotal(),
            'sp_sup_total'=>$this->getSpSupTotal(),
            'sp_vat'=>$this->getSpVat(),
            'sup_total'=>$this->getSupTotal(),
            'vat'=>$this->getVat(),
            'total'=>$this->getTotal(),

        ];
    }
}
