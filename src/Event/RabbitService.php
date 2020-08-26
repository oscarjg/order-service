<?php

namespace App\Event;

/**
 * Class RabbitService
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
class RabbitService implements EventPublisherInterface
{
    protected $rabbitClient;

    /**
     * RabbitService constructor.
     *
     * @param RabbitClient $rabbitClient
     */
    public function __construct(RabbitClient $rabbitClient)
    {
        $this->rabbitClient = $rabbitClient;
    }

    public function publish(EventInterface $event)
    {
        $this->rabbitClient->publish(
            $event->getName(),
            $event->getPayload()
        );
    }
}

