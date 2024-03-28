<?php

namespace App\KhadamatTeck\Base\FCM;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Created by Mohammed Alomair on 09/02/2022.
 */
class FirebaseService
{
    public function client(): Client
    {
        return new Client([
            'headers' => [
                "content-type" => "application/json",
                "Authorization" => "key=" . env('FCM_TOKEN'),
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     */
    private function postNotification($data): ResponseInterface
    {
        return $this->client()->post(env('FCM_URL'), [
            'body' => json_encode($data),
            'headers' => [
                //'Content-Type' => 'application/json',
            ]
        ]);
    }

    // -----------------------------------------------------------------------------------------------------------------

    public function sendNotification($data)
    {
        $response = $this->postNotification($data);

        $result["status"] = $response->getStatusCode();
        $result["message"] = $response->getStatusCode() == 200 ? "Sent successfully" : "Unknown Error";
        $result["response"] = json_decode((string)$response->getBody());
        //$result["payload"] = $data;
        return $result;
    }

    // -----------------------------------------------------------------------------------------------------------------


    public function sendNotifyByToken($token, ?FirebaseMessageData $data, $deviceType = "ios")
    {
        return $this->sendNotification((new FirebaseMessage($token, $data, $deviceType, true)));
    }

    public function sendNotifyByTopic($topic, ?FirebaseMessageData $data, $deviceType = "ios")
    {
        return $this->sendNotification((new FirebaseMessage($topic, $data, $deviceType, false)));
    }

    // -----------------------------------------------------------------------------------------------------------------

    public function sendNotify($user, $type, $title, $body, $payload = []): array
    {
        if ($user && $user->fcm_token) {
            $result = $this->sendNotifyByToken(
                token: $user->fcm_token,
                data: new FirebaseMessageData($type, $title, $body, $payload),
                deviceType: $user->device_data['type'] ?? "ios",
            );
        }
        return $result ?? [];
    }
}
