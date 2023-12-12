<?php

namespace Tests\Feature\Customer\Checkout;

use App\DTOs\Cart\AddToCartDto;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\Cart\Implementations\CartServiceImpl;
use App\Services\Cart\Interfaces\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private CartService $cartService;

    public function setUp(): void {
        parent::setUp();
        $this->cartService = App::make(CartServiceImpl::class);
    }

    public function test_checkout_with_COD_success()
    {
        $variant = $this->insertProductVariant(1);

        // add cart for checkout
        $addToCartDto = new AddToCartDto($variant->product_id, $variant->color_id, 'M', 1);
        $this->cartService->addToCart($addToCartDto);

        $checkoutRequest = [
            'name' => 'Vu Ba Manh',
            'phonenumber' => '0868166754',
            'email' => 'email01@gmail.com',
            'address' => 'Ha Noi, Viet Nam',
            'payment_method' => 'COD'
        ];

        $response = $this->post(route('checkout'), $checkoutRequest);

        $order = Order::first();

        $response->assertRedirectToRoute('checkout.success', ['code' => $order->code])
                 ->assertSessionHas('success');
        
        $this->assertDatabaseHas('orders', [
            'code' => $order->code,
            'customer_name' => $checkoutRequest['name'],
            'phone_number' => $checkoutRequest['phonenumber'],
            'email' => $checkoutRequest['email'],
            'address' => $checkoutRequest['address'],
        ]);

        // ensure cart has been remove after checkout
        $this->assertTrue($this->cartService->getCartCount() === 0);
    }

    public function test_checkout_failed_if_product_out_of_stock()
    {
        $variant = $this->insertProductVariant(1);

        // add cart for checkout
        $addToCartDto = new AddToCartDto($variant->product_id, $variant->color_id, 'M', 1);
        $this->cartService->addToCart($addToCartDto);

        // decrease product's quantity to zero
        ProductVariant::find($variant->id)->decrement('quantity', 1);

        $checkoutRequest = [
            'name' => 'Vu Ba Manh',
            'phonenumber' => '0868166754',
            'email' => 'email01@gmail.com',
            'address' => 'Ha Noi, Viet Nam',
            'payment_method' => 'COD'
        ];

        $response = $this->post(route('checkout'), $checkoutRequest);

        $response->assertSessionHas('error');
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
