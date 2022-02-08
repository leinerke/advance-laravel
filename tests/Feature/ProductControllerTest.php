<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_index()
    {
        /** @var Product $product */
        Product::factory(5)->create();
        $response = $this->getJson('/api/products');
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5);
    }

    public function test_create_new_product()
    {
        $data = [
            'name' => 'Hola',
            'price' => 10000
        ];
        $response = $this->postJson('/api/products', $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('products', $data);
    }

    public function test_update_product()
    {
        /** @var Product $product */
        $product = Product::factory()->create();
        $data = [
            'name' => 'Update Product',
            'price' => 20000
        ];
        $response = $this->patchJson("/api/products/$product->id", $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function test_show_product()
    {
        /** @var Product $product */
        $product = Product::factory()->create();
        $response = $this->getJson("/api/products/$product->id");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertEquals($product->name, $response->json('name'));
    }

    public function test_delete_product()
    {
        /** @var Product $product */
        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/$product->id");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseCount('products', 0);
    }
}
