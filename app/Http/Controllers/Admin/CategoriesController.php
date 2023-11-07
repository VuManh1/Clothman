<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Categories\CategoryParamsDto;
use App\DTOs\Categories\CreateCategoryDto;
use App\DTOs\Categories\UpdateCategoryDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Categories\Interfaces\GetCategoriesService;
use App\Services\Categories\Interfaces\ManageCategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(
        private GetCategoriesService $getCategoriesService,
        private ManageCategoriesService $manageCategoriesService,
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
        $params = CategoryParamsDto::fromRequest($request);
        $categories = $this->getCategoriesService->getCategories($params);

        return view("admin.categories.index", ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesService->getCategories();
        return view("admin.categories.create", ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $request->validated();

        $createCategoryDto = CreateCategoryDto::fromRequest($request);

        $category = $this->manageCategoriesService->createCategory($createCategoryDto);

        return redirect()->route("categories.index")->with("success", $category->name." created !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->getCategoriesService->getCategoryById($id);

        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->getCategoriesService->getCategoryById($id);
        $categories = $this->getCategoriesService->getCategories();

        return view("admin.categories.edit", compact("category", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $request->validated();

        $updateCateDto = UpdateCategoryDto::fromRequest($request);

        $category = $this->manageCategoriesService->updateCategory($id, $updateCateDto);

        return redirect()->route("categories.index")->with("success", $category->name." updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->manageCategoriesService->deleteCategory($id);

        return redirect()->route("categories.index")->with("success", "Category deleted !");
    }
}
