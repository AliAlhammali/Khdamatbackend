<?php

namespace App\KhadamatTeck\Base\checkout\entity;

class GenerateLinkResponse extends CheckoutResponse implements \JsonSerializable
{
    private string $payment_id = "";
    private string $payment_link = "";

    public function getPaymentId(): string
    {
        return $this->payment_id;
    }

    public function setPaymentId(string $payment_id): void
    {
        $this->payment_id = $payment_id;
    }

    public function getPaymentLink(): string
    {
        return $this->payment_link;
    }

    public function setPaymentLink(string $payment_link): self
    {
        $this->payment_link = $payment_link;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'status' => $this->isSuccessful(),
            'payment_id' => $this->getPaymentId(),
            'payment_link' => $this->getPaymentLink(),
            'message' => $this->getMessage(),
            'error' => $this->getError(),
        ];
    }
}
