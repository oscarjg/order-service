<?php

namespace App\Order;

/**
 * Interface OrderLineInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
interface OrderLineInterface
{
    /**
     * @param string $sku
     * @param float $price
     * @param int $quantity
     *
     * @return mixed
     */
    public static function createInstance(
        string $sku,
        float $price,
        int $quantity
    );

    /**
     * @param string $sku
     *
     * @return OrderLineInterface
     */
    public function setSku(string $sku) :self;

    /**
     * @return string
     */
    public function getSku() :string;

    /**
     * @return float
     */
    public function getPrice() :float;

    /**
     * @param float $price
     *
     * @return OrderLineInterface
     */
    public function setPrice(float $price) :self;

    /**
     * @return int
     */
    public function getQuantity() :int;

    /**
     * @param int $quantity
     *
     * @return OrderLineInterface
     */
    public function setQuantity(int $quantity) :self;

    /**
     * @param OrderInterface $order
     *
     * @return OrderLineInterface
     */
    public function setOrder(OrderInterface $order) :self;

    /**
     * @return OrderInterface
     */
    public function getOrder() :OrderInterface;
}
