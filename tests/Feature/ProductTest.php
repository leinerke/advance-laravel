<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_category()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Category $category */
        $category = Category::factory()->create();
        /** @var Product $product */
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'created_by' => $user->id,
        ]);
        $this->assertInstanceOf(Category::class, $product->category);
    }

    public function test_a_product_belongs_to_user()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Product $product */
        $product = Product::factory()->create(['created_by' => $user->id]);
        $this->assertInstanceOf(User::class, $product->user);
    }
}
