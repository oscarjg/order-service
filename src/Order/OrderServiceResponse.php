<?php

namespace App\Order;

/**
 * Class OrderServiceResponse
 *
 * Public access for simplicity purpose
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Order
 */
class OrderServiceResponse
{
    /**
     * @var OrderInterface
     */
    public $order;

    /**
     * @var int
     */
    public $status;

    /**
     * @var string
     */
    public $errorMessage;

    /**
     * OrderServiceResponse constructor.
     *
     * @param OrderInterface $order
     * @param int $status
     * @param string $errorMessage
     */
    public function __construct(?OrderInterface $order, int $status, $errorMessage = '')
    {
        $this->order = $order;
        $this->status = $status;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return bool
     */
    public function isSuccess() :bool
    {
        return $this->status === 1;
    }
}
