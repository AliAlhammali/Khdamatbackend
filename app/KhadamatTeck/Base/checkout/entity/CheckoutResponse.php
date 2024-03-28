<?php

namespace App\KhadamatTeck\Base\checkout\entity;

class CheckoutResponse implements \JsonSerializable
{
    private bool $is_successful = false;
    private string $message = "";
    private array $result = [];
    private array $error = [];

    public function setIsSuccessful(bool $is_successful): void
    {
        $this->is_successful = $is_successful;
    }

    public function isSuccessful(): bool
    {
        return $this->is_successful;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setResult(array $result): void
    {
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getError(): array
    {
        return $this->error;
    }

    public function setError(array $error): self
    {
        $this->error = $error;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'is_successful' => $this->isSuccessful(),
            'message' => $this->getMessage(),
            'result' => $this->getResult(),
            'error' => $this->getError(),
        ];
    }
}
