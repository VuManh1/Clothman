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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = $this->getColorsService->get();
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

}
