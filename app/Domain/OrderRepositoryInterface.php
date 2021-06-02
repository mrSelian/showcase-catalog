<?php

namespace App\Domain;
interface OrderRepositoryInterface
{
    public function getById(int $id): ?Order;

    public function save(Order $order);

    public function mapToOrder();

    public function getAllAvailable();

}
