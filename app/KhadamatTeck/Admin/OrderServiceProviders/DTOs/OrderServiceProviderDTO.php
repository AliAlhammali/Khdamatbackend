<?php

namespace App\KhadamatTeck\Admin\OrderServiceProviders\DTOs;

class OrderServiceProviderDTO implements \JsonSerializable
{
    private ?int $id = null;
    private ?string $order_id = null;
    private ?string $service_provider_id = null;
    private ?bool $active = null;


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
    public function getServiceProviderId(): ?string
    {
        return $this->service_provider_id;
    }

    /**
     * @param string|null $service_provider_id
     */
    public function setServiceProviderId(?string $service_provider_id): void
    {
        $this->service_provider_id = $service_provider_id;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     */
    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'order_id' => $this->getOrderId(),
            'service_provider_id' => $this->getServiceProviderId(),
            'active' => $this->getActive(),

        ];
    }
}
