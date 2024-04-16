<?php

namespace App\KhadamatTeck\Admin\Services\DTOs;

class ServiceDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?array $title = null;
    private ?array $slug = null;
    private ?string $description = null;
    private ?string $status = null;
    private ?int $merchant_id = null;
    private ?float $price = 0.00;
    private ?float $cost_price = 0.00;
    private ?float $sp_price = 0.00;
    private mixed $category =null;
    private mixed $merchant =null;
    private ?int $main_category_id = null;

    private ?int $category_id = null;
    private mixed $main_category =null;

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
    }

    /**
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
    }

    /**
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getCategory(): mixed
    {
        return $this->category;
    }

    public function setCategory(mixed $category): void
    {
        $this->category = $category;
    }

    public function getMerchant(): mixed
    {
        return $this->merchant;
    }

    public function setMerchant(mixed $merchant): void
    {
        $this->merchant = $merchant;
    }

    public function getCostPrice(): ?float
    {
        return $this->cost_price;
    }

    public function setCostPrice(?float $cost_price): void
    {
        $this->cost_price = $cost_price;
    }

    public function getSpPrice(): ?float
    {
        return $this->sp_price;
    }

    public function setSpPrice(?float $sp_price): void
    {
        $this->sp_price = $sp_price;
    }

    public function getMainCategoryId(): ?int
    {
        return $this->main_category_id;
    }

    public function setMainCategoryId(?int $main_category_id): void
    {
        $this->main_category_id = $main_category_id;
    }

    public function getMainCategory(): mixed
    {
        return $this->main_category;
    }

    public function setMainCategory(mixed $main_category): void
    {
        $this->main_category = $main_category;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'merchant_id' => $this->getMerchantId(),
            'category_id' => $this->getCategoryId(),
            'main_category_id' => $this->getMainCategoryId(),
            'price' => $this->getPrice(),
            'category'=>$this->getCategory(),
            'main_category' => $this->getMainCategory(),
            'merchant'=>$this->getMerchant(),
            'cost_price'=>$this->getCostPrice(),
            'sp_price'=>$this->getSpPrice(),
        ];
    }
}
