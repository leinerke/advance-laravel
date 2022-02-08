<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_index()
    {
        /** @var Category $category */
        Category::factory(5)->create();
        $response = $this->getJson('/api/categories');
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5);
    }

    public function test_create_new_category()
    {
        $data = [
            'name' => 'Hola',
        ];
        $response = $this->postJson('/api/categories', $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_update_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();
        $data = [
            'name' => 'Update Category',
        ];
        $response = $this->patchJson("/api/categories/$category->id", $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function test_show_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();
        $response = $this->getJson("/api/categories/$category->id");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertEquals($category->name, $response->json('name'));
    }

    public function test_delete_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();
        $response = $this->deleteJson("/api/categories/$category->id");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseCount('categories', 0);
    }
}
