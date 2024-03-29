<?php

namespace App\KhadamatTeck\Merchant\Services\DTOs;

class ServiceDTO implements \JsonSerializable
{
            private ?int $id= null;
            private ?array $title= null;
            private ?array $slug= null;
            private ?string $description= null;
            private ?string $status= null;
            private ?int $merchant_id= null;
            private ?int $category_id= null;


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
     * @return array|null
     */
    public function getTitle(): ?array
    {
        return $this->title;
    }

/**
     * @param array|null $title
     */
    public function setTitle(?array $title): void
    {
        $this->title = $title;
    }/**
     * @return array|null
     */
    public function getSlug(): ?array
    {
        return $this->slug;
    }

/**
     * @param array|null $slug
     */
    public function setSlug(?array $slug): void
    {
        $this->slug = $slug;
    }/**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

/**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
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
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

/**
     * @param int|null $category_id
     */
    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function jsonSerialize()
    {
        return [
                        'id'=>$this->getId(),
            'title'=>$this->getTitle(),
            'slug'=>$this->getSlug(),
            'description'=>$this->getDescription(),
            'status'=>$this->getStatus(),
            'merchant_id'=>$this->getMerchantId(),
            'category_id'=>$this->getCategoryId(),

        ];
    }
}
