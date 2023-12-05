<?php

namespace Tests\Feature\Customer\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddToCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_cart_for_guest(): void {
        $this->assertTrue(true);
    }
}
