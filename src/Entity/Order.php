<?php

namespace App\Entity;

use App\Order\OrderInterface;
use App\Order\OrderLineInterface;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order implements OrderInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $totalAmount;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="order", orphanRemoval=true, cascade={"persist"})
     */
    private $orderLines;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $state;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
        $this->id = 0;
        $this->state = null;
        $this->totalAmount = 0;
    }

    /**
     * @param array $orderLines
     * @param string $state
     *
     * @return mixed|void
     */
    public static function createInstance(array $orderLines, string $state)
    {
        $order = new self();
        $order->state = $state;
        $order->totalAmount = self::calculateAmountFromLines($orderLines);
        $order->orderLines = new ArrayCollection(
            array_map(function(OrderLineInterface $orderLine) use ($order) {
                $orderLine->setOrder($order);
                return $orderLine;
            }, $orderLines)
        );

        return $order;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param float $totalAmount
     *
     * @return OrderInterface
     */
    public function setTotalAmount(float $totalAmount): OrderInterface
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @param OrderLineInterface $orderLine
     *
     * @return OrderInterface
     */
    public function addOrderLine(OrderLineInterface $orderLine): OrderInterface
    {
        if ($this->orderLines->contains($orderLine) === false) {
            $this->orderLines->add($orderLine);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrderLines(): Collection
    {
       return $this->orderLines;
    }

    public function setState(string $state): OrderInterface
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param OrderLineInterface[] $orderLines
     *
     * @return float
     */
    protected static function calculateAmountFromLines($orderLines) :float
    {
        $amount = 0;

        foreach ($orderLines as $orderLine) {
            $amount += $orderLine->getPrice() * $orderLine->getQuantity();
        }

        return $amount;
    }
}
