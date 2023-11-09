<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Products\ProductParamsDto;
use App\Http\Controllers\Controller;
use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Http\Request;
use App\Services\Products\Interfaces\GetProductsService;
use App\Services\Products\Interfaces\ManageProductsService;

class ProductsController extends Controller
{
    public function __construct(
        private GetCategoriesService $getCategoriesService,
        private GetProductsService $getProductsService,
        private ManageProductsService $manageProductsService
    ) {
        $this->middleware('role:ADMIN,null,null')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = ProductParamsDto::fromRequest($request);
        $products = $this->getProductsService->getProducts($params);

        $this->appendPaginatorURL($products);

        return view("admin.products.index", ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesService->getCategories();
        return view("admin.products.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->getProductsService->getProductById($id);

        return view("admin.products.show", ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->getProductsService->getProductById($id);
        $categories = $this->getCategoriesService->getCategories();

        return view("admin.products.edit", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
