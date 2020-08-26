<?php

namespace App\Event;

/**
 * Interface EventInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Event
 */
interface EventInterface
{
    /**
     * @return string
     */
    public function getName() :string;

    /**
     * @return array
     */
    public function getPayload() :array;
}