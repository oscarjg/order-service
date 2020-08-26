<?php

namespace App\Order;

/**
 * Class OrderState
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
class OrderStates
{
    const PENDING_CONFIRMATION = "pending_confirmation";
    const CONFIRMED = "confirmed";
    const SENT_TO_WAREHOUSE = "sent_to_warehouse";
    const SHIPPED = "shipped";
    const TRANSIT = "transit";
    const DELIVERED = "delivered";
}
