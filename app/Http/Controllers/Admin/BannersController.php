<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Banners\BannerParamsDto;
use App\DTOs\Banners\CreateBannerDto;
use App\DTOs\Banners\UpdateBannerDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Services\Banners\Interfaces\GetBannersService;
use App\Services\Banners\Interfaces\ManageBannersService;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function __construct(
        private GetBannersService $getBannersService,
        private ManageBannersService $manageBannersService,
    ) {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = BannerParamsDto::fromRequest($request);
        $banners = $this->getBannersService->getBannersByParams($params);

        $this->appendPaginatorUrl($banners);

        return view("admin.banners.index", ["banners" => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.banners.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {
        $createBannerDto = CreateBannerDto::fromRequest($request);

        $banner = $this->manageBannersService->createBanner($createBannerDto);

        return redirect()->route("admin.banners.index")->with("success", $banner->name." created !");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->getBannersService->getBannerById($id);

        return view("admin.banners.show", compact("banner"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->getBannersService->getBannerById($id);

        return view("admin.banners.edit", compact("banner"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $updateBannerDto = UpdateBannerDto::fromRequest($request);

        $banner = $this->manageBannersService->updateBanner($id, $updateBannerDto);

        return redirect()->route("admin.banners.index")->with("success", $banner->name." updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->manageBannersService->deleteBanner($id);

        return redirect()->route("admin.banners.index")->with("success", "Banner deleted !");
    }
}
