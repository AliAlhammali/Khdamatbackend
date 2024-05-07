<?php

namespace App\KhadamatTeck\Admin\Orders\Listeners;

use App\KhadamatTeck\Admin\Orders\Events\OrderSpAssigned;
use App\KhadamatTeck\Admin\OrderServiceProviders\Models\OrderServiceProvider;

class AddSPToOrderSPListLog
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
        OrderServiceProvider::where('service_provider_id', $event->getOrder()->service_provider_id)->update(['active' => 0]);
        OrderServiceProvider::create([
            'order_id' => $event->getOrder()->id ?? null,
            'service_provider_id' => $event->getOrder()->service_provider_id ?? null,
            'service_provider_user_id' => $event->getOrder()->service_provider_user_id ?? null,
            'active' => 1,
        ]);
    }
}
