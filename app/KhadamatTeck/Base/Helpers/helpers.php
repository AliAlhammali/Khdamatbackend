<?php

use App\KhadamatTeck\Base\Enums\GeneralVatPercentage;
use App\KhadamatTeck\Base\Traits\GuzzleClient;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Smartisan\Settings\Facades\Settings;

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

if (!function_exists('calculate_vat')) {
    /**
     * @param float|int $price
     *
     * @return array['price_before_vat','vat','vat_percentage']
     */
    function calculate_vat(float|int $price, $vat_included = true, $vatGeneralPercentage = null): array
    {
        if (!$vatGeneralPercentage) {
            $vatGeneralPercentage = Settings::group('vat')->get('vat') ?? GeneralVatPercentage::SaudiArabiaVat;
        }
        if ($price == 0) {
            return [
                'price_before_vat' => 0,
                'price_with_vat' => 0,
                'vat' => 0,
                'vat_percentage' => $vatGeneralPercentage,
            ];
        }
        $SalesVatRate = $vatGeneralPercentage / 100;
        if (!$vat_included) {
            $PriceBeforeVat = $price;
            $price_with_vat = $price * (1 + $SalesVatRate);
        } else {
            $PriceBeforeVat = ($price / (1 + $SalesVatRate));
            $price_with_vat = $price;
        }
        $SalesVat = round($price_with_vat - $PriceBeforeVat, 2);
        return [
            'price_before_vat' => round($PriceBeforeVat, 2),
            'price_with_vat' => round($price_with_vat, 2),
            'vat' => $SalesVat,
            'vat_percentage' => $vatGeneralPercentage,
        ];
    }
}

if (!function_exists('discount')) {

    function discount(float|int $price, $percentage = 0): array
    {
        $discount = $price / 100 * $percentage;
        return [
            'price_before_discount' => $price,
            'price_with_discount' => $price - $discount,
            'discount' => $discount,
            'discount_percentage' => $percentage,
        ];
    }
}

if (!function_exists('discount')) {

    function discount(float|int $price, $percentage = 0): array
    {
        $discount = $price / 100 * $percentage;
        return [
            'price_before_discount' => $price,
            'price_with_discount' => $price - $discount,
            'discount' => $discount,
            'discount_percentage' => $percentage,
        ];
    }
}

if (!function_exists('create_order_reference')) {
    /**
     * @param         $order
     *
     * @return string
     */
    function create_order_reference($order): string
    {
        $type_text = ucfirst(substr($order->type, 0, 2));
        $cat_text = ucfirst(substr($order->category->getTranslation('name', 'en'), 0, 2));
        $data_text = Carbon::parse($order->created_at)->tz('Asia/Riyadh')->format('ymd');
        return $type_text . '-' . $cat_text . '-'
            . $data_text . '-' . ($order->number ?? 0);
    }
}

if (!function_exists('dropColumnsIfExists')) {
    /**
     * Drop any column in database table
     * @param $table
     * @param array|string $columns
     */
    function dropColumnsIfExists($table, array|string $columns): void
    {
        if (Schema::hasColumns($table, is_array($columns) ? $columns : [$columns])) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
}

if (!function_exists('siteTimestamps')) {
    function siteTimestamps(&$table, $softDelete = false): void
    {

        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        if ($softDelete)
            $table->softDeletes();
    }
}

if (!function_exists('getTranslations')) {
    /**
     * @param $item object database record
     * @param $key string name of column inside item
     * @return array|null
     */
    function getTranslations($item, string $key): ?array
    {
        $description = $item->getTranslations($key) ?? [];
        if (count($description) == 0)
            return null;
        return $description;
    }
}


if (!function_exists('document_not_found')) {

    function document_not_found($message = 'Document file not found', $code = 404): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'errors' => (object)['file'=>$message],
            'data' => (new \stdClass()),
            'extra_data' => (new \stdClass()),
            'message' => $message
        ],
            $code
        );
    }
}

