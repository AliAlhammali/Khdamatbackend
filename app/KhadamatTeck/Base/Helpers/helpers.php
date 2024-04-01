<?php

use App\KhadamatTeck\Base\Traits\GuzzleClient;
use Illuminate\Support\Facades\Log;

if (!function_exists('AdminAuth')) {

    function AdminAuth()
    {
        return auth('admin');
    }
}

if (!function_exists('MerchantAuth')) {

    function MerchantAuth()
    {
        return auth('merchant');
    }
}

if (!function_exists('SPAuth')) {

    function SPAuth()
    {
        return auth('service-provider');
    }
}

if (!function_exists('IsApiRequest')) {

    function IsApiRequest($request)
    {
        return $request->is('api/*');
    }
}

if (!function_exists('send_sms')) {
    function send_sms($phone, $message, $code = '966'): void
    {
        $phoneNumber = (int)international_phone($phone, $code);
        try {
//            app('unifonic')->client->send(
//                $phoneNumber,
//                $message,
//                config('services.unifonic.sender_id')
//            );
            (new GuzzleClient())->post(env("Khadamat_OTP_URL", "https://khadamat-teck.com"), [
                "phone" => $phoneNumber,
                "message" => $message,
                "token" => env("Khadamat_OTP_TOKEN", "d92d6df170d345c68e7a9aa38aa1f2a6")
            ]);
        } catch (\Exception $exception) {
            Log::emergency('unifonic failed', [
                "phone" => $phone,
                "code" => $code,
                "phoneNUmber" => $phoneNumber,
                "message" => $message,
                'exception' => $exception->getMessage()
            ]);
        }
    }
}

if (!function_exists('international_phone')) {
    function international_phone($phone, $code = '966')
    {
        if ($code == '966') {
            if (str_starts_with($phone, $code))   // It starts with country code like 966
                return $phone;
            else if (str_starts_with($phone, "+$code"))   // It starts with '+966'
                return substr($phone, 1);
            else if (str_starts_with($phone, '0'))   // It starts with '0'
                return $code . substr($phone, 1);
            else return $code . $phone;
        }
        return $phone;
    }
}

