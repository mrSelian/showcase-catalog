<?php

namespace Tests\Feature;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Models\ProductModel;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected ProductRepositoryInterface $productRepository;
    protected Product $product;
    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->app->make(ProductRepositoryInterface::class);

        $this->seed(DatabaseSeeder::class);

        $this->product = $this->productRepository->getAllAvailable()->first();

        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->withoutExceptionHandling();
    }

    public function test_create_product_page_is_available()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('create_product'));

        $response->assertStatus(200);
    }

    public function test_edit_product_page_is_available()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('edit_product', $this->product->getId()));

        $response->assertStatus(200);
    }

    public function test_product_can_be_added()
    {
        $productDump = $this->makeProductDump();

        $this->actingAs($this->admin);

        $response = $this->post(route('store_product'), $productDump);

        $product = $this->productRepository->getById(session('productId'));

        $this->assertProduct($productDump,$product);
    }

    public function test_product_can_be_deleted()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('delete_product', $this->product->getId()));

        $product = $this->productRepository->getById($this->product->getId());

        $this->assertTrue($product->isDeleted());
    }

    public function test_product_can_be_changed()
    {
        $productDump = $this->makeProductDump();

        $this->actingAs($this->admin);

        $response = $this->patch(route('update_product', $this->product->getId()), $productDump);

        $changedProduct = $this->productRepository->getById($this->product->getId());

        $this->assertProduct($productDump,$changedProduct);
    }


    //
    protected function assertProduct($productDump,Product $product)
    {
        $this->assertEquals($productDump['title'], $product->getTitle());
        $this->assertEquals($productDump['description'], $product->getDescription());
        $this->assertEquals($productDump['price'], $product->getPrice());
        $this->assertEquals($productDump['oldPrice'], $product->getOldPrice());
        $this->assertEquals($productDump['amount'], $product->getAmount());
        $this->assertEquals($productDump['brand'], $product->getBrand());
        $this->assertEquals($productDump['liquid'], $product->getQuality('liquid'));
        $this->assertEquals($productDump['hard'], $product->getQuality('hard'));
        $this->assertEquals($productDump['wet'], $product->getQuality('wet'));
        $this->assertEquals($productDump['warm'], $product->getQuality('warm'));
    }

    protected function makeProductDump(): array
    {
        $productDump = ProductModel::factory()->make(['old_price' => 99999])->toArray();

        unset($productDump['photos']);

        $productDump['photo1'] = UploadedFile::fake()->image('photo.jpg');

        $productDump['oldPrice'] = $productDump['old_price'];

        unset($productDump['old_price']);

        return $productDump;
    }
}
