<?php

namespace App\Event;

use App\Order\OrderInterface;

/**
 * Interface OrderEventInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
interface OrderEventInterface extends EventInterface
{
    const ORDER_CREATED = "order_created";
    const ORDER_CONFIRMED = "order_confirmed";

    /**
     * @return OrderInterface
     */
    public function getOrder() :OrderInterface;
}