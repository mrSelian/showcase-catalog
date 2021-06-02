<?php

namespace App\Repositories;

use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;
use App\Helpers\PaginationHelper;
use App\Models\OrderModel;

class DbOrderRepository implements OrderRepositoryInterface
{
    protected const RECORDS_PER_PAGE = 15;

    public function getById(int $id): ?Order
    {
        return OrderModel::withId($id)
            ->get()
            ->map($this->mapToOrder())
            ->first();
    }

    public function save(Order $order)
    {
        $record = OrderModel::withId($order->getId())->firstOrNew();

        $record->customer = $order->getCustomerName();
        $record->phone = $order->getCustomerPhone();
        $record->product_id = $order->getProductId();
        $record->save();
    }

    public function mapToOrder(): \Closure
    {
        return fn(OrderModel $record) => Order::from(
            $record->customer,
            $record->phone,
            $record->product_id,
            $record->id
        );
    }

    public function getAllAvailable()
    {
        $orders = OrderModel::query()
            ->get()
            ->map($this->mapToOrder());
        return PaginationHelper::paginate($orders, self::RECORDS_PER_PAGE);
    }
}
