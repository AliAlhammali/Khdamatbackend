<?php

namespace App\KhadamatTeck\Admin\Orders\DTOs;

use Carbon\Carbon;

class OrderItemDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?int $merchant_id = null;
    private ?int $merchant_user_id = null;
    private ?int $merchant_client_id = null;
    private ?int $main_category_id = null;
    private ?string $status = null;
    private ?string $order_otp = null;
    private ?string $created_at = null;
    private ?string $pick_up_type = null;
    private ?int $merchant_branch_id = null;
    private mixed $completed_at = null;
    private mixed $started_at = null;

    private mixed $address = null;
    private mixed $totals = null;
    private mixed $items = null;


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
     * @return int|null
     */
    public function getMerchantUserId(): ?int
    {
        return $this->merchant_user_id;
    }

    /**
     * @param int|null $merchant_user_id
     */
    public function setMerchantUserId(?int $merchant_user_id): void
    {
        $this->merchant_user_id = $merchant_user_id;
    }

    /**
     * @return int|null
     */
    public function getMerchantClientId(): ?int
    {
        return $this->merchant_client_id;
    }

    /**
     * @param int|null $merchant_client_id
     */
    public function setMerchantClientId(?int $merchant_client_id): void
    {
        $this->merchant_client_id = $merchant_client_id;
    }

    /**
     * @return int|null
     */
    public function getMainCategoryId(): ?int
    {
        return $this->main_category_id;
    }

    /**
     * @param int|null $main_category_id
     */
    public function setMainCategoryId(?int $main_category_id): void
    {
        $this->main_category_id = $main_category_id;
    }

    /**
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

    /**
     * @return string|null
     */
    public function getOrderOtp(): ?string
    {
        return $this->order_otp;
    }

    /**
     * @param string|null $order_otp
     */
    public function setOrderOtp(?string $order_otp): void
    {
        $this->order_otp = $order_otp;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return Carbon::parse($this->created_at);
    }

    /**
     * @param string|null $created_at
     */
    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string|null
     */
    public function getPickUpType(): ?string
    {
        return $this->pick_up_type;
    }

    /**
     * @param string|null $pick_up_type
     */
    public function setPickUpType(?string $pick_up_type): void
    {
        $this->pick_up_type = $pick_up_type;
    }

    /**
     * @return string|null
     */
    public function getMerchantBranchId(): ?string
    {
        return $this->merchant_branch_id;
    }

    /**
     * @param string|null $merchant_branch_id
     */
    public function setMerchantBranchId(?string $merchant_branch_id): void
    {
        $this->merchant_branch_id = $merchant_branch_id;
    }

    public function getCompletedAt(): mixed
    {
        return $this->completed_at;
    }

    public function setCompletedAt(mixed $completed_at): void
    {
        $this->completed_at = $completed_at;
    }

    public function getStartedAt(): mixed
    {
        return $this->started_at;
    }

    public function setStartedAt(mixed $started_at): void
    {
        $this->started_at = $started_at;
    }

    public function getAddress(): mixed
    {
        return $this->address;
    }

    public function setAddress(mixed $address): void
    {
        $this->address = $address;
    }

    public function getTotals(): mixed
    {
        return $this->totals;
    }

    public function setTotals(mixed $totals): void
    {
        $this->totals = $totals;
    }

    public function getItems(): mixed
    {
        return $this->items;
    }

    public function setItems(mixed $items): void
    {
        $this->items = $items;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'merchant_id' => $this->getMerchantId(),
            'merchant_user_id' => $this->getMerchantUserId(),
            'merchant_client_id' => $this->getMerchantClientId(),
            'main_category_id' => $this->getMainCategoryId(),
            'status' => $this->getStatus(),
            'order_otp' => $this->getOrderOtp(),
            'created_at' => $this->getCreatedAt(),
            'pick_up_type' => $this->getPickUpType(),
            'merchant_branch_id' => $this->getMerchantBranchId(),
            'started_at' => $this->getStartedAt(),
            'completed_at' => $this->getCompletedAt(),
            'address' => $this->getAddress(),
            'totals' => $this->getTotals(),
            'items' => $this->getItems(),

        ];
    }
}
