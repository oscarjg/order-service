<?php

namespace App\Repository;

/**
 * Interface PersistenceInterface
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Repository
 */
interface PersistenceInterface
{
    public function save($data);
    public function find(int $id);
}