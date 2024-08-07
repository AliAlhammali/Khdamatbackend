<?php

namespace App\KhadamatTeck\Admin\Dashboard\DTOs;

class DashboardTopCategoryServiceDTO implements \JsonSerializable
{
    private int $order_count = 0;
    private ?int $category_id = 0;
    private ?int $service_id = 0;
    private array $name = [];

    public function getOrderCount(): int
    {
        return $this->order_count;
    }

    public function setOrderCount(int $order_count): void
    {
        $this->order_count = $order_count;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getServiceId(): ?int
    {
        return $this->service_id;
    }

    public function setServiceId(?int $service_id): void
    {
        $this->service_id = $service_id;
    }

    public function getName(): array
    {
        return $this->name;
    }

    public function setName(array $name): void
    {
        $this->name = $name;
    }




    public function jsonSerialize()
    {
        return [
            "order_count" => $this->getOrderCount(),
            "name" => $this->getName(),
            "category_id" => $this->getCategoryId(),
            "service_id" => $this->getServiceId(),
        ];
    }
}
