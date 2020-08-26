<?php

namespace App\Order;

use App\Event\EventPublisherInterface;
use App\Event\OrderConfirmedEvent;
use App\Event\OrderCreatedEvent;
use App\Event\OrderEventInterface;
use App\Repository\PersistenceInterface;

/**
 * Class OrderService
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
class OrderService
{
    /**
     * @var PersistenceInterface
     */
    protected $orderRepository;

    /**
     * @var EventPublisherInterface
     */
    protected $eventPublisher;

    /**
     * OrderService constructor.
     *
     * @param PersistenceInterface $orderRepository
     * @param EventPublisherInterface $eventPublisher
     */
    public function __construct(
        PersistenceInterface $orderRepository,
        EventPublisherInterface $eventPublisher
    ) {
        $this->orderRepository = $orderRepository;
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * @param CreateOrderObject $createOrderObject
     *
     * @return OrderServiceResponse
     */
    public function createOrder(CreateOrderObject $createOrderObject) :OrderServiceResponse
    {
        $order = OrderFactory::createInitialOrder($createOrderObject);

        return $this->handle(
            $order,
            new OrderCreatedEvent($order)
        );
    }

    /**
     * @param int $orderId
     *
     * @return OrderServiceResponse
     */
    public function confirmOrder(int $orderId) :OrderServiceResponse
    {
        /**
         * @var OrderInterface $order
         */
        $order = $this->orderRepository->find($orderId);

        if ($order === null) {
            return new OrderServiceResponse($order, 0, "Order not found");
        }

        $order->setState(OrderStates::CONFIRMED);

        return $this->handle(
            $order,
            new OrderConfirmedEvent($order)
        );
    }

    public function sendOrderToWarehouse(OrderInterface $order) :OrderServiceResponse
    {
        // TODO
    }

    public function shipOrder(OrderInterface $order) :OrderServiceResponse
    {
        // TODO
    }

    public function transitOrder(OrderInterface $order) :OrderServiceResponse
    {
        // TODO
    }

    public function deliverOrder(OrderInterface $order) :OrderServiceResponse
    {
        // TODO
    }

    /**
     * @param OrderInterface $order
     * @param OrderEventInterface $event
     *
     * @return OrderServiceResponse
     */
    private function handle(OrderInterface $order, OrderEventInterface $event) :OrderServiceResponse
    {
        try {
            $this->orderRepository->save($order);
            $this->eventPublisher->publish($event);

            return new OrderServiceResponse($order, 1);
        } catch (\Throwable $exception) {
            // Write some logs here
            // ....

            return new OrderServiceResponse($order, 0, $exception->getMessage());
        }
    }
}
