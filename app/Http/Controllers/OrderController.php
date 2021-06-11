<?php

namespace App\Http\Controllers;

use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    protected OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function store(CreateOrderRequest $request): RedirectResponse
    {
        $order = Order::create(
            $request->customer,
            $request->phone,
            $request->productId
        );
        $this->orderRepository->save($order);

        $id = $this->orderRepository->save($order);

        return redirect()->route('catalog')->with('success', 'Спасибо за заказ! Наши менеджеры свяжутся с вами в ближайшее время.')->with('orderId', $id);
    }
}
