<?php

namespace App\Event;

/**
 * Interface EventPublisherInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
interface EventPublisherInterface
{
    public function publish(EventInterface $event);
}