<?php

namespace App\Event;

use App\Order\OrderInterface;

/**
 * Class OrderCreatedEvent
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
class OrderCreatedEvent implements OrderEventInterface
{
    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * OrderCreatedEvent constructor.
     *
     * @param $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::ORDER_CREATED;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return [
            "id" => $this->order->getId(),
            "occurred_on" => time(),
        ];
    }

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface
    {
        return $this->order;
    }
}
