<?php

namespace App\KhadamatTeck\Base\FCM;

class FirebaseMessage implements \JsonSerializable
{
    public function __construct(
        private string $to,  // "REGISTRATION_TOKEN" or "/topics/TOPIC_NAME"
        private FirebaseMessageData $data,
        private string $device_type = "ios",
        private bool $isToToken = true)
    {
        $this->to = $this->isToToken ? $to : "/topics/$to";
    }

    private $android = [
        "priority" => "high",
    ];

    private $notification = [
        'title' => "",
        'body' => "",
        'sound' => 'notification.wav', //'Default',
        'content-available' => '1'
    ];

    private $apns = [
        "headers" => [
            "apns-priority" => "5"
        ],
    ];
    private $priority = "high";

    public function jsonSerialize()
    {
        $payload = [
            "to" => $this->to,
            "data" => $this->data,
        ];

        if ($this->device_type != "ios") {
            $payload["android"] = $this->android;

        } else {
            $this->notification["title"] = $this->data->getTitle() ?? null;
            $this->notification["body"] = $this->data->getBody() ?? null;

            $payload["notification"] = $this->notification;
            $payload["apns"] = $this->apns;
            $payload["priority"] = $this->priority;
        }

        return $payload;
    }
}
