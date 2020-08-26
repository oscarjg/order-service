<?php

namespace App\Order;

use App\Entity\Order;

/**
 * Class OrderFactory
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
class OrderFactory
{
    /**
     * @param CreateOrderObject $createOrderObject
     *
     * @return OrderInterface
     */
    static function createInitialOrder(CreateOrderObject $createOrderObject) :OrderInterface
    {
        return Order::createInstance(
            $createOrderObject->orderLines,
            OrderStates::PENDING_CONFIRMATION
        );
    }
}
