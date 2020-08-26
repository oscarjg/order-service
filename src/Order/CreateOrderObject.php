<?php

namespace App\Order;

use App\Entity\OrderLine;

/**
 * Class NewOrderObject
 *
 * Public access for simplicity purpose
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
class CreateOrderObject
{

    /**
     * @var OrderLineInterface[]
     */
    public $orderLines;

    /**
     * CreateOrderObject constructor.
     *
     * @param array $orderLines
     */
    public function __construct(array $orderLines)
    {
        // Some validations required here
        // ....

        foreach ($orderLines as $orderLine) {
            $this->orderLines[] = OrderLine::createInstance(
                $orderLine["sku"],
                $orderLine["price"],
                $orderLine["quantity"]
            );
        }
    }
}
