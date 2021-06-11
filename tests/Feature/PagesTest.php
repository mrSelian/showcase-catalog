<?php

namespace Tests\Feature;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected ProductRepositoryInterface $productRepository;
    protected Product $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->app->make(ProductRepositoryInterface::class);

        $this->seed(DatabaseSeeder::class);

        $this->product = $this->productRepository->getAllAvailable()->first();

        $this->withoutExceptionHandling();
    }

    public function test_catalog_page_can_be_rendered()
    {
        $response = $this->get(route('catalog'));

        $response->assertStatus(200);
    }

    public function test_products_can_be_rendered_on_catalog_page()
    {
        $products = $this->productRepository->getAllAvailable();

        $response = $this->get(route('catalog'));

        foreach ($products as $product) {
            $this->assertSeeProductCard($response, $product);
        }
    }

    public function test_product_page_can_be_rendered()
    {
        $response = $this->get(route('show_product', $this->product->getId()));

        $response->assertStatus(200);
    }

    public function test_product_info_can_be_rendered_on_product_page()
    {
        $response = $this->get(route('show_product', $this->product->getId()));

        $this->assertSeeProduct($response, $this->product);
    }

    //
    protected function assertSeeProduct(TestResponse $response, Product $product)
    {
        $response->assertSee([
            $product->getTitle(),
            mb_strtoupper($product->getBrand()),
            $product->getDescription(),
            $product->getPrice()
        ]);
    }

    protected function assertSeeProductCard(TestResponse $response, Product $product)
    {
        $response->assertSee([
            $product->getTitle(),
            $product->getPrice()
        ]);
    }
}
