<?php

namespace App\KhadamatTeck\Admin\Orders\DTOs;

class OrderDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?string $merchant_id = null;
    private ?string $merchant_user_id = null;
    private ?string $merchant_client_id = null;
    private ?string $main_category_id = null;
    private ?string $category_id = null;
    private ?string $status = null;
    private ?string $order_otp = null;
    private ?string $created_at = null;
    private ?string $pick_up_type = null;
    private ?string $merchant_branch_id = null;


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
    }

    /**
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
    }

    /**
     * @return string|null
     */
    public function getMerchantClientId(): ?string
    {
        return $this->merchant_client_id;
    }

    /**
     * @param string|null $merchant_client_id
     */
    public function setMerchantClientId(?string $merchant_client_id): void
    {
        $this->merchant_client_id = $merchant_client_id;
    }

    /**
     * @return string|null
     */
    public function getMainCategoryId(): ?string
    {
        return $this->main_category_id;
    }

    /**
     * @param string|null $main_category_id
     */
    public function setMainCategoryId(?string $main_category_id): void
    {
        $this->main_category_id = $main_category_id;
    }

    /**
     * @return string|null
     */
    public function getCategoryId(): ?string
    {
        return $this->category_id;
    }

    /**
     * @param string|null $category_id
     */
    public function setCategoryId(?string $category_id): void
    {
        $this->category_id = $category_id;
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
        return $this->created_at;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'merchant_id' => $this->getMerchantId(),
            'merchant_user_id' => $this->getMerchantUserId(),
            'merchant_client_id' => $this->getMerchantClientId(),
            'main_category_id' => $this->getMainCategoryId(),
            'category_id' => $this->getCategoryId(),
            'status' => $this->getStatus(),
            'order_otp' => $this->getOrderOtp(),
            'created_at' => $this->getCreatedAt(),
            'pick_up_type' => $this->getPickUpType(),
            'merchant_branch_id' => $this->getMerchantBranchId(),

        ];
    }
}
