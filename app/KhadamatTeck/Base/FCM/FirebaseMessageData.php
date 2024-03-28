<?php

namespace App\KhadamatTeck\Base\FCM;

class FirebaseMessageData implements \JsonSerializable
{
    private ?string $app = "KhadamatTeck";

    public function __construct(
        private string $type,
        private string $title,
        private string $body,
        private ?array $payload = [],
    )
    {
    }

    /**
     * @return string|null
     */
    public function getApp(): ?string
    {
        return $this->app;
    }

    /**
     * @param string|null $app
     */
    public function setApp(?string $app): void
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }



    /**
     * @return array|null
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param array|null $payload
     */
    public function setPayload(?array $payload): void
    {
        $this->payload = $payload;
    }

    public function jsonSerialize()
    {
        return [
            'app' => $this->app,
            'type' => $this->type,
            'title' => $this->title,
            'body' => $this->body,
            'payload' => $this->payload,
        ];
    }
}
