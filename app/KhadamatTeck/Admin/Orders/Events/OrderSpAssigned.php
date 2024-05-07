<?php

namespace App\KhadamatTeck\Admin\Orders\Events;

use App\KhadamatTeck\Admin\Orders\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderSpAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    private Order $order;

    public function __construct($order, $serviceProvider)
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
