<?php

namespace App\Services\Products\Implementations;

use App\Exceptions\Products\ProductVariantCanNotDeleteException;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Products\Interfaces\ManageProductVariantsService;
use App\Repositories\Interfaces\ProductVariantRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ManageProductVariantsServiceImpl implements ManageProductVariantsService
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductVariantRepository $productVariantRepository,
    ) {}

    public function updateProductVariantQuantity(string $id, int $quantity): bool {
        if ($quantity < 0) throw ValidationException::withMessages(['Quantity must not less than 0']);

        $productVariant = $this->productVariantRepository->findById($id, ['product']);

        if (!$productVariant) throw new ModelNotFoundException();

        // if quantity equal to variant quantity, simply return true
        if ($productVariant->quantity === $quantity) return true;

        $offsetPrice = $quantity - $productVariant->quantity;

        DB::beginTransaction();
        try {
            $this->productVariantRepository->update($productVariant->id, [
                'quantity' => $quantity
            ]);

            $quantityToUpdate = $productVariant->product->quantity + $offsetPrice;
            $this->productRepository->update($productVariant->product_id, [
                'quantity' => $quantityToUpdate
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }        

        return true;
    }

    public function deleteProductVariant(string $id): bool {
        $productVariant = $this->productVariantRepository->findById($id);
        $product = $this->productRepository->findById($productVariant->product_id, ['productVariants']);

        if ($product->productVariants->count() === 1) {
            throw new ProductVariantCanNotDeleteException("Can not delete variant because product must have at least 1 variant");
        }

        $haveOrder = $this->productVariantRepository->checkHaveOrder($id);

        if ($haveOrder) throw new ProductVariantCanNotDeleteException("Can not delete variant because it have more than 1 order.");

        DB::beginTransaction();
        try {
            $this->productVariantRepository->delete($id);

            $this->productRepository->update($product->id, [
                'quantity' => $product->quantity - $productVariant->quantity
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        } 

        return true;
    }
}
