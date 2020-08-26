<?php

namespace App\Tests\Unit\Order;

use App\Order\CreateOrderObject;
use App\Order\OrderFactory;
use App\Tests\Unit\UnitTestCase;

/**
 * Class OrderFactoryTest
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Tests\Unit\Order
 */
class OrderFactoryTest extends UnitTestCase
{
    /**
     * @param CreateOrderObject $createOrderObject
     *
     * @dataProvider initialOrderData
     */
    public function testInitialOrder(CreateOrderObject $createOrderObject)
    {
        $order = OrderFactory::createInitialOrder($createOrderObject);

        $this->assertEquals(
            $order->getState(),
            "pending_confirmation"
        );

        $this->assertEquals(3, count($order->getOrderLines()));
        $this->assertEquals(59.65, $order->getTotalAmount());
    }

    /**
     * @return array
     */
    public function initialOrderData() :array
    {
        return [
            [
                new CreateOrderObject(
                    [
                        ["sku" => "sku-1", "price" => 10.00, "quantity" => 2],
                        ["sku" => "sku-2", "price" => 2.15, "quantity" => 1],
                        ["sku" => "sku-3", "price" => 12.50, "quantity" => 3],
                    ],
                "Foo address",
                "Bar address"
                )
            ]
        ];
    }
}