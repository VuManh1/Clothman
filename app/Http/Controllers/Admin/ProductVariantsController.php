<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Products\CreateProductVariantDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductVariantRequest;
use App\Services\Products\Interfaces\GetProductsService;
use Illuminate\Http\Request;
use App\Services\Products\Interfaces\ManageProductVariantsService;

class ProductVariantsController extends Controller
{
    public function __construct(
        private GetProductsService $getProductsService,
        private ManageProductVariantsService $manageProductVariantsService,
    ) {}

    /**
     * Show product variants
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $product = $this->getProductsService->getProductById($id, ['images', 'productVariants.color']);

        return view('admin.products.variants', compact('product'));
    }

    /**
     * Handle create product variant
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductVariantRequest $request)
    {
        $data = CreateProductVariantDto::fromRequest($request);
        $this->manageProductVariantsService->createProductVariant($data);

        return response()->json(['success' => true]);
    }

    /**
     * Handle update product variant's quantity
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request, $id)
    {
        $this->manageProductVariantsService->updateProductVariantQuantity($id, $request->quantity);

        return response()->json(['success' => true]);
    }

    /**
     * Handle delete product variant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->manageProductVariantsService->deleteProductVariant($id);

        return response()->json(['success' => true ]);
    }
}
