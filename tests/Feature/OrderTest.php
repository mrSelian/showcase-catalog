<?php

namespace Tests\Feature;

use App\Domain\OrderRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected OrderRepositoryInterface $orderRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderRepository = $this->app->make(OrderRepositoryInterface::class);

        $this->withoutExceptionHandling();
    }

    public function test_order_can_be_created()
    {
        $customer = 'Василий Иванович Пупкин';
        $phone = '+79999999999';
        $productId = 111;

        $response = $this->post(route('make_order'), [
            'customer' => $customer,
            'phone' => $phone,
            'productId' => $productId,
        ]);

        $order = $this->orderRepository->getById(session('orderId'));

        $this->assertEquals($customer, $order->getCustomerName());
        $this->assertEquals($phone, $order->getCustomerPhone());
        $this->assertEquals($productId, $order->getProductId());
    }

}
