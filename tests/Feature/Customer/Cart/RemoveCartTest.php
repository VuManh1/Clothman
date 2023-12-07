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

class RemoveCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_remove_cart_for_guest() {
        $variant = $this->insertProductVariant(1);

        $response = $this->withSession([
            'carts' => [
                [
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'quantity' => 1,
                ]
            ]
        ])->delete(route('api.cart.destroy'), [
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $response->assertSessionHas('carts', []);
    }

    public function test_remove_cart_for_authenticated_customer() {
        $user = User::create([
            'name' => 'Test customer',
            'email' => 'email1@gmail.com',
            'role' => 'CUSTOMER'
        ]);

        $variant = $this->insertProductVariant(1);

        // Insert cart
        Cart::create([
            'product_id' => $variant->product_id,
            'product_variant_id' => $variant->id,
            'user_id' => $user->id,
            'quantity' => 1
        ]);

        $response = $this->actingAs($user)->delete(route('api.cart.destroy'), [
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('carts', [
            'product_id' => $variant->product_id,
            'product_variant_id' => $variant->id,  
            'user_id' => $user->id,  
        ]);
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
