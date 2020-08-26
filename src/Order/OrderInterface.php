<?php

namespace App\Order;

use Doctrine\Common\Collections\Collection;

/**
 * Interface OrderInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
interface OrderInterface
{
    /**
     * @param array $orderLines
     * @param string $state
     *
     * @return mixed
     */
    public static function createInstance(
        array $orderLines,
        string $state
    );

    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @return float
     */
    public function getTotalAmount(): ?float;

    /**
     * @param float $totalAmount
     *
     * @return OrderInterface
     */
    public function setTotalAmount(float $totalAmount) :self;

    /**
     * @param OrderLineInterface $orderLine
     *
     * @return OrderInterface
     */
    public function addOrderLine(OrderLineInterface $orderLine) :self;

    /**
     * @return Collection
     */
    public function getOrderLines(): Collection;

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $state
     *
     * @return OrderInterface
     */
    public function setState(string $state): self;
}
