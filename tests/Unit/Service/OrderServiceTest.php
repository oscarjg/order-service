<?php

namespace App\Tests\Unit\Order;

use App\Event\RabbitService;
use App\Order\CreateOrderObject;
use App\Entity\Order;
use App\Order\OrderStates;
use App\Order\OrderService;
use App\Repository\OrderRepository;
use App\Tests\Unit\UnitTestCase;

/**
 * Class OrderFactoryTest
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Tests\Unit\Order
 */
class OrderServiceTest extends UnitTestCase
{
    public function testCreateOrder()
    {
        $response = $this
            ->orderService($this->orderRepositoryStub())
            ->createOrder($this->createOrderObject());

        $this->assertEquals(
            $response->order->getState(),
            "pending_confirmation"
        );

        $this->assertEquals(1, $response->status);
    }

    public function testConfirmedOrder()
    {
        $response = $this
            ->orderService($this->orderRepositoryStub())
            ->confirmOrder(1);

        $this->assertEquals(
            $response->order->getState(),
            "confirmed"
        );

        $this->assertEquals(1, $response->status);
    }

    public function testConfirmedOrderBadRequest()
    {
        $response = $this
            ->orderService($this->orderRepositoryNotFoundStub())
            ->confirmOrder(1);

        $this->assertNull($response->order);

        $this->assertEquals(0, $response->status);
    }

    /**
     * @return CreateOrderObject
     */
    private function createOrderObject() :CreateOrderObject
    {
        return new CreateOrderObject(
            [
                ["sku" => "sku-1", "price" => 10.00, "quantity" => 2],
                ["sku" => "sku-2", "price" => 2.15, "quantity" => 1],
                ["sku" => "sku-3", "price" => 12.50, "quantity" => 3],
            ]
        );
    }

    /**
     * @param $orderRepositoryStub
     *
     * @return OrderService
     */
    private function orderService($orderRepositoryStub) :OrderService
    {
        $rabbitServiceStub = $this->createMock(RabbitService::class);

        $rabbitServiceStub
            ->method('publish')
            ->willReturn(true);

        return  new OrderService(
            $orderRepositoryStub,
            $rabbitServiceStub
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function orderRepositoryStub()
    {
        $orderRepositoryStub = $this->createMock(OrderRepository::class);

        $orderRepositoryStub
            ->method('save')
            ->willReturn(true);

        $orderRepositoryStub
            ->method('find')
            ->willReturnCallback(function(){
                return Order::createInstance(
                    [],
                    OrderStates::PENDING_CONFIRMATION
                );
            })
        ;

        return $orderRepositoryStub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function orderRepositoryNotFoundStub()
    {
        $orderRepositoryStub = $this->createMock(OrderRepository::class);

        $orderRepositoryStub
            ->method('save')
            ->willReturn(true);

        $orderRepositoryStub
            ->method('find')
            ->willReturnCallback(function(){
                return null;
            })
        ;

        return $orderRepositoryStub;
    }
}
