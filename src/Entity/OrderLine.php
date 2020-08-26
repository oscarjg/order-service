<?php

namespace App\Entity;

use App\Order\OrderInterface;
use App\Order\OrderLineInterface;
use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine implements OrderLineInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sku;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @param string $sku
     * @param float $price
     * @param int $quantity
     *
     * @return mixed|void
     */
    public static function createInstance(string $sku, float $price, int $quantity)
    {
        $orderLine = new self();
        $orderLine->sku = $sku;
        $orderLine->price = $price;
        $orderLine->quantity = $quantity;

        return $orderLine;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param float $price
     *
     * @return OrderLineInterface
     */
    public function setPrice(float $price): OrderLineInterface
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param int $quantity
     *
     * @return OrderLineInterface
     */
    public function setQuantity(int $quantity): OrderLineInterface
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param string $sku
     *
     * @return OrderLineInterface
     */
    public function setSku(string $sku): OrderLineInterface
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderLineInterface
     */
    public function setOrder(OrderInterface $order): OrderLineInterface
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface
    {
        return $this->order;
    }
}
