<?php

namespace App\Event;

use Psr\Log\LoggerInterface;

/**
 * Class RabbitClient
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
class RabbitClient
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * RabbitClient constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $eventName
     * @param array $payload
     */
    public function publish($eventName, array $payload)
    {
        $this->logger->info(
            json_encode([$eventName => $payload])
        );
    }
}
