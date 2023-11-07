<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        $colors = $this->getColorsService->get();
        return view("admin.colors.index", ["colors" => $colors]);
    }

    public function create()
    {
        return view("admin.colors.create");
    }

    public function store(CreateColorRequest $request)
    {
        $request->validated();

        $createColorDto = CreateColorDto::fromRequest($request);

        $color = $this->manageColorsService->createColor($createColorDto);

        return redirect()->route("colors.index")->with("success","");
    }

}
