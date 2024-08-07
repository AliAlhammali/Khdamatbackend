<?php

namespace App\KhadamatTeck\Merchant\Orders\Requests;

use App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use MatanYadaev\EloquentSpatial\Objects\Point;

class CreateOrderRequest extends KhadamatTeckRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "main_category_id" => 'required',
            "items" => 'required|array',
            "items.*.item_id" => 'required',
            "items.*.quantity" => 'required',
            "address.location" => 'required|array',
            "address.location.lat" => 'required',
            "address.location.long" => 'required',
            "merchant_branch_id" => 'nullable',
            "pick_up_type" => 'required',
            "started_at" => 'required',
        ];
    }

    protected function passedValidation()
    {
        $loggedInSeller = MerchantAuth()->user();
        $order_commission_percentage = (float)$loggedInSeller->order_commission_percentage;
        $items = $this->get('items', []);
        $itemsCollection = collect($this->get('items', []));
        $services = ServiceModel::whereIn('id', $itemsCollection->pluck('item_id')->toArray())->get();
        $services = $services->keyBy('id');
        $orderTotal = 0;
        $orderVat = 0;
        $orderSupTotal = 0;
        $sp_sup_total = 0;
        $sp_vat = 0;
        $sp_total = 0;
        $orderFullTotal = [];
        $newItemData = [];
        foreach ($items as $item) {
            $service = $services[$item['item_id']];
            $price = calculate_vat($service->price * $item['quantity'], false);
            $orderSupTotal += (float)$price['price_before_vat'];
            $orderVat += (float)$price['vat'];
            $orderTotal += (float)$price['price_with_vat'];

            $sp_totals = calculate_vat($service->sp_price * $item['quantity'], false);
            $sp_sup_total += (float)$sp_totals['price_before_vat'];
            $sp_vat += (float)$sp_totals['vat'];
            $sp_total += (float)$sp_totals['price_with_vat'];
            $newItemData[] = [
                "item_id" => (int)$item['item_id'],
                "quantity" => (int)$item['quantity'],
                "item_price" => (float)$service->price,
                "sup_total" => (float)$price['price_before_vat'],
                "vat" => (float)$price['vat'],
                "total" => (float)$price['price_with_vat'],
                "sp_item_price" => (float)$service->sp_price,
                "sp_sup_total" => (float)$sp_totals['price_before_vat'],
                "sp_vat" => (float)$sp_totals['vat'],
                "sp_total" => (float)$sp_totals['price_with_vat'],
                "category_id" => $service->category_id,
            ];

        }

        $profit = $orderTotal - $sp_total;
        $sellerCommission = $profit / 100 * $order_commission_percentage;
        $profitAfterCommission = calculate_vat($profit - $sellerCommission, false);
        $sellerCommission = calculate_vat($sellerCommission, false);
        $orderFullTotal = [
            'merchant_id' => $loggedInSeller->merchant_id,
            'merchant_user_id' => $loggedInSeller->id,
            "sup_total" => $orderSupTotal,
            "vat" => $orderVat,
            "total" => $orderTotal,

            "sp_vat" => $sp_vat,
            "sp_sup_total" => $sp_sup_total,
            "sp_total" => $sp_total,

            "merchant_user_commission_total" => (float)$sellerCommission['vat'],
            "merchant_user_commission_sup_total" => (float)$sellerCommission['price_before_vat'],
            "merchant_user_commission_vat" => (float)$sellerCommission['price_with_vat'],


            "profit_vat" => (float)$profitAfterCommission['vat'],
            "profit_sup_total" => (float)$profitAfterCommission['price_before_vat'],
            "profit_total" => (float)$profitAfterCommission['price_with_vat'],

        ];
        $_address = $this->get('address');
        if($this->pick_up_type != 'from_branch')
            $_address['pick_up_location'] = $_address['location'];
        if ($this->get('merchant_client_id', false)) {

            $client = MerchantClient::where(['id' => $this->get('merchant_client_id', false)])->first();

            $_address = [
                "name" => $client->name,
                "email" => $client->email,
                "phone" => $client->phone,
                "address" => $client->address,
                "location" => new Point($_address['location']['lat'], $_address['location']['long']),
                "pick_up_location" => new Point($_address['pick_up_location']['lat'], $_address['pick_up_location']['long']),
                "is_default_address" => 1
            ];
        } else {
            $clientData = $_address;
            $clientData['location'] = new Point($_address['location']['lat'], $_address['location']['long']);
            $client = MerchantClient::create($clientData);
            $_address = [
                "name" => $client->name,
                "email" => $client->email,
                "phone" => $client->phone,
                "address" => $client->address,
                "location" => new Point($_address['location']['lat'], $_address['location']['long']),
                "pick_up_location" => new Point($_address['pick_up_location']['lat'], $_address['pick_up_location']['long']),
                "is_default_address" => 1
            ];
            $this->merge([
                'merchant_client_id' => $client->id
            ]);
        }
        $this->merge([
            'totals' => $orderFullTotal,
            'items' => $newItemData,
            'address' => $_address,
            'merchant_id' => $loggedInSeller->merchant_id,
            'merchant_user_id' => $loggedInSeller->id,

        ]);
    }
}
