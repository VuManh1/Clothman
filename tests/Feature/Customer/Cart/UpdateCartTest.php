<?php

namespace Tests\Feature\Customer\Cart;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_cart_for_guest() {
        $variant = $this->insertProductVariant(2);
        $currentQuantity = 1;
        $quantityToUpdate = 2;

        $response = $this->withSession([
            'carts' => [
                [
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $currentQuantity,
                ]
            ]
        ])->patch(route('api.cart.update'), [
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
            'quantity' => $quantityToUpdate,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $response->assertSessionHas('carts', [
            [
                'product_id' => $variant->product_id,
                'product_variant_id' => $variant->id,
                'quantity' => $quantityToUpdate,
            ]
        ]);
    }

    public function test_update_cart_for_authenticated_customer() {
        $user = User::create([
            'name' => 'Test customer',
            'email' => 'email1@gmail.com',
            'role' => 'CUSTOMER'
        ]);

        $variant = $this->insertProductVariant(2);
        $currentQuantity = 1;
        $quantityToUpdate = 2;

        // Insert cart
        Cart::create([
            'product_id' => $variant->product_id,
            'product_variant_id' => $variant->id,
            'user_id' => $user->id,
            'quantity' => $currentQuantity
        ]);

        $response = $this->actingAs($user)->patch(route('api.cart.update'), [
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
            'quantity' => $quantityToUpdate,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('carts', [
            'product_id' => $variant->product_id,
            'product_variant_id' => $variant->id,
            'user_id' => $user->id,
            'quantity' => $quantityToUpdate
        ]);
    }

    public function test_it_throw_exception_if_product_out_of_stock() {
        $variant = $this->insertProductVariant(1);
        $quantityToUpdate = 2;

        $response = $this->withSession([
            'carts' => [
                [
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'quantity' => 1,
                ]
            ]
        ])->patch(route('api.cart.update'), [
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
            'quantity' => $quantityToUpdate,
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
