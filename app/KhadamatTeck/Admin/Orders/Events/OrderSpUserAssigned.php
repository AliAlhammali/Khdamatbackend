<?php

namespace App\KhadamatTeck\Admin\Orders\Events;

use App\KhadamatTeck\Admin\Orders\Models\Order;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderSpUserAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    private Order $order;

    public function __construct($order)
    {
        $this->setOrder($order);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }


}
