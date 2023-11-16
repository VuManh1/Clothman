<?php

namespace App\Services\Cart\Implementations;

use App\DTOs\Cart\AddToCartDto;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use App\Services\Cart\Interfaces\CartService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartServiceImpl implements CartService
{
    public function __construct(
        private CartRepository $cartRepository,
        private ProductVariantRepository $productVariantRepository,
    ) {}

    public function getCartData(): array {
        if (Auth::check()) {
            $carts = $this->cartRepository->getAllByUserId(Auth::id());
            $total = 0;

            foreach ($carts as $cart) {
                $total += $cart->getPrice();
            }

            return [
                'items' => $carts,
                'total' => $total,
            ];
        } else {
            return collect([
                'items' => [],
                'total' => 0,
            ]);
        }
    }

    public function getCartCount(): int {
        if (Auth::check()) {
            return $this->cartRepository->getCountByUserId(Auth::id());
        }

        return 0;
    }

    public function addToCart(AddToCartDto $data): bool {
        $productVariant = $this->productVariantRepository->findByDetail(
            $data->productId,
            $data->colorId,
            $data->size,
        );

        if (!$productVariant) {
            throw new ModelNotFoundException();
        }

        if (Auth::check()) {
            $userId = Auth::id();
            $cart = $this->cartRepository->findByDetail($data->productId, $productVariant->id, $userId);

            if ($cart) {
                $this->cartRepository->update($cart->id, [
                    'quantity' => $cart->quantity + $data->quantity,
                ]);
            } else {
                $this->cartRepository->create([
                    'product_id' => $data->productId,
                    'product_variant_id' => $productVariant->id,
                    'user_id' => $userId,
                    'quantity' => $data->quantity,
                ]);
            }
        } else {
            
        }

        return true;
    }
}
