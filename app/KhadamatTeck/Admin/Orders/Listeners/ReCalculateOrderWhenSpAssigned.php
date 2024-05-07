<?php

namespace App\KhadamatTeck\Admin\Orders\Listeners;

use App\KhadamatTeck\Admin\Orders\Events\OrderSpAssigned;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;

class ReCalculateOrderWhenSpAssigned
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderSpAssigned $event): void
    {
        $serviceProvider = $event->getOrder()->serviceProvider;
        $order = $event->getOrder();
        $items = $order->items;
        $total = $order->total;
        $sp_sup_total = 0;
        $sp_vat = 0;
        $sp_total = 0;
        foreach ($items as $item) {
            $services = ServiceModel::where('id',$item->item_id )->first();
            $sp_totals = calculate_vat($services->sp_price * $item->quantity, !$serviceProvider->can_collect_vat);
            $sp_sup_total+= $item->sp_item_price = (float)$services->sp_price;
            $sp_sup_total+= $item->sp_sup_total = (float)$sp_totals['price_before_vat'];
            $sp_vat+=$item->sp_vat = (float)$sp_totals['vat'];
            $sp_total+=$item->sp_total = (float)$sp_totals['price_with_vat'];
            $item->save();
        }

        $total->sp_sup_total = $sp_sup_total;
        $total->sp_vat = $sp_vat;
        $total->sp_total = $sp_total;
        $total->save();
    }
}
