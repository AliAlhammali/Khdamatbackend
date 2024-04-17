<?php

namespace App\KhadamatTeck\Admin\Categories\DTOs;

class CategoryDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?array $title = null;
    private ?array $slug = null;
    private ?string $status = null;
    private ?int $merchant_id = null;
    private mixed $merchant = null;
    private mixed $parent = null;
    private mixed $children = null;


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

    public function getMerchantId(): ?int
    {
        return $this->merchant_id;
    }

    public function setMerchantId(?int $merchant_id): void
    {
        $this->merchant_id = $merchant_id;
    }

    public function getMerchant(): mixed
    {
        return $this->merchant;
    }

    public function setMerchant(mixed $merchant): void
    {
        $this->merchant = $merchant;
    }

    public function getParent(): mixed
    {
        return $this->parent;
    }

    public function setParent(mixed $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): mixed
    {
        return $this->children;
    }

    public function setChildren(mixed $children): void
    {
        $this->children = $children;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'status' => $this->getStatus(),
            'merchant_id' => $this->getMerchantId(),
            'merchant' => $this->getMerchant(),
            'children' => $this->getChildren(),
            'parent' => $this->getParent(),


        ];
    }
}
