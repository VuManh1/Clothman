<?php

namespace App\Http\Controllers\Admin;

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
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = $this->getColorsService->getColors();
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

    public function show($id)
    {
        $color = $this->getColorsService->getColorsById($id);

        return view("admin.colors.show", compact("color"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateColorRequest $request)
    {
        $request->validated();

        $createColorDto = CreateColorDto::fromRequest($request);

        $color = $this->manageColorsService->createColor($createColorDto);


        return redirect()->route("colors.index")->with("success","");
    }

    public function edit($id)
    {
        $color = $this->getColorsService->getColorsById($id);
        $colors = $this->getColorsService->getColors();


        return view("admin.colors.edit", compact("color", "colors"));
    }

    public function update(UpdateColorRequest $request, $id)
    {
        $request->validated();

        $updateColorDto = UpdateColorDto::fromRequest($request);

        $color = $this->manageColorsService->updateColor($id, $updateColorDto);

        return redirect()->route("colors.index")->with("success", $color->name." updated !");
    }

    public function destroy($id)
    {
        $this->manageColorsService->deleteColor($id);

        return redirect()->route("colors.index")->with("success", "Color deleted !");
    }

}
