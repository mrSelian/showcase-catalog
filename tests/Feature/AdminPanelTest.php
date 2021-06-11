<?php

namespace Tests\Feature;

use App\Domain\Order;
use App\Domain\OrderRepositoryInterface;
use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected ProductRepositoryInterface $productRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->app->make(ProductRepositoryInterface::class);

        $this->orderRepository = $this->app->make(OrderRepositoryInterface::class);

        $this->seed(DatabaseSeeder::class);

        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->withoutExceptionHandling();
    }

    public function test_orders_can_be_rendered_on_orders_page()
    {
        $orders = $this->orderRepository->getAllAvailable();

        $this->actingAs($this->admin);

        $response = $this->get(route('admin_orders'));

        foreach ($orders as $order) {
            $this->assertSeeOrder($response, $order);
        }
    }

    public function test_products_can_be_rendered_on_products_page()
    {
        $products = $this->productRepository->getAllNotDeleted();

        $this->actingAs($this->admin);

        $response = $this->get(route('admin_products'));

        foreach ($products as $product) {
            $this->assertSeeProductAdmin($response, $product);
        }
    }

    //
    protected function assertSeeProductAdmin(TestResponse $response, Product $product)
    {
        $response->assertSee([
            $product->getTitle(),
            $product->getPrice(),
            $product->getAmount()
        ]);
    }

    protected function assertSeeOrder(TestResponse $response, Order $order)
    {
        $response->assertSee([
            $order->getCustomerName(),
            $order->getCustomerPhone()
        ]);
    }
}
