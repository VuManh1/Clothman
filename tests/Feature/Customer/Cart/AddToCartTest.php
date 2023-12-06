<?php

namespace Tests\Feature\Customer\Cart;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AddToCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_cart_for_guest(): void {
        $variant = $this->insertProductVariant(2);
        $quantityToAdd = 1;

        $response = $this->post(route('api.cart.store'), [
            'product_id' => $variant->product_id,
            'color_id' => $variant->color_id,
            'size' => $variant->size,
            'quantity' => $quantityToAdd,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(201);
        $response->assertSessionHas('carts', [
            [
                'product_id' => $variant->product_id,
                'product_variant_id' => $variant->id,
                'quantity' => $quantityToAdd,
            ]
        ]);
    }

    public function test_add_to_cart_for_authenticated_customer(): void {
        $user = User::create([
            'name' => 'Test customer',
            'email' => 'email1@gmail.com',
            'role' => 'CUSTOMER'
        ]);

        $variant = $this->insertProductVariant(2);
        $quantityToAdd = 1;

        $response = $this->actingAs($user)->post(route('api.cart.store'), [
            'product_id' => $variant->product_id,
            'color_id' => $variant->color_id,
            'size' => $variant->size,
            'quantity' => $quantityToAdd,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('carts', [
            'product_id' => $variant->product_id,
            'product_variant_id' => $variant->id,
            'user_id' => $user->id,
            'quantity' => $quantityToAdd
        ]);
    }

    public function test_it_throw_exception_if_product_out_of_stock() {
        $variant = $this->insertProductVariant(1);
        $quantityToAdd = 2;

        $response = $this->post(route('api.cart.store'), [
            'product_id' => $variant->product_id,
            'color_id' => $variant->color_id,
            'size' => $variant->size,
            'quantity' => $quantityToAdd,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(500);
    }

    private function insertProductVariant(int $quantity) {
        $product = Product::create([
            'name' => 'Ao',
            'slug' => 'ao',
            'thumbnail_url' => 'thumb',
            'code' => Str::random(10)
        ]);

        $color = Color::create([
            'name' => 'Xanh',
            'hex_code' => '#111111'
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'color_id' => $color->id,
            'size' => 'M',
            'quantity' => $quantity
        ]);

        return $variant;
    }
}
