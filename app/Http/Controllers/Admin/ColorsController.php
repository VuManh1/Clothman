<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Colors\ColorParamsDto;
use App\DTOs\Colors\UpdateColorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Color\UpdateColorRequest;
use Illuminate\Http\Request;
use App\DTOs\Colors\CreateColorDto;
use App\Http\Requests\Color\CreateColorRequest;
use App\Services\Colors\Interfaces\GetColorsService;
use App\Services\Colors\Interfaces\ManageColorsService;

class ColorsController extends Controller
{
    public function __construct(
        private GetColorsService $getColorsService,
        private ManageColorsService $manageColorsService,
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
        $params = ColorParamsDto::fromRequest($request);
        $colors = $this->getColorsService->getColorsByParams($params);

        $this->appendPaginatorURL($colors);

        return view("admin.colors.index", ["colors" => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.colors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateColorRequest $request)
    {
        $request->validated();

        $createColorDto = CreateColorDto::fromRequest($request);

        $color = $this->manageColorsService->createColor($createColorDto);

        return redirect()->route("admin.colors.index")->with("success", $color->name." created !");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $color = $this->getColorsService->getColorById($id);

        return view("admin.colors.show", compact("color"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = $this->getColorsService->getColorById($id);

        return view("admin.colors.edit", compact("color"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorRequest $request, $id)
    {
        $request->validated();

        $updateColorDto = UpdateColorDto::fromRequest($request);

        $color = $this->manageColorsService->updateColor($id, $updateColorDto);

        return redirect()->route("admin.colors.index")->with("success", $color->name." updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->manageColorsService->deleteColor($id);

        return redirect()->route("admin.colors.index")->with("success", "Color deleted !");
    }
}
