<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Banners\BannerParamsDto;
use App\DTOs\Banners\CreateBannerDto;
use App\DTOs\Banners\UpdateBannerDto;
use App\Exceptions\UniqueFieldException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Services\Banners\Interfaces\GetBannersService;
use App\Services\Banners\Interfaces\ManageBannersService;
use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function __construct(
        private GetBannersService $getBannersService,
        private ManageBannersService $manageBannersService,
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
        $params = BannerParamsDto::fromRequest($request);
        $banners = $this->getBannersService->getBannersByParams($params);

        $this->appendPaginatorUrl($banners);

        return view("admin.banners.index", ["banners" => $banners]);
    }

    public function create()
    {
        return view("admin.banners.create");
    }

    public function store(CreateBannerRequest $request)
    {
        $request->validated();

        $createBannerDto = CreateBannerDto::fromRequest($request);

        try {
            $banner = $this->manageBannersService->createBanner($createBannerDto);
        } catch (UniqueFieldException $ex) {
            return back()->with('error', $ex->getMessage());
        }

        return redirect()->route("banners.index")->with("success", $banner->name." created !");
    }

    public function show($id)
    {
        $banner = $this->getBannersService->getBannerById($id);

        return view("admin.banners.show", compact("banner"));
    }

    public function edit($id)
    {
        $banner = $this->getBannersService->getBannerById($id);

        return view("admin.banners.edit", compact("banner", "banners"));
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        $request->validated();

        $updateBannerDto = UpdateBannerDto::fromRequest($request);

        try {
            $banner = $this->manageBannersService->updateBanner($id, $updateBannerDto);
        } catch (UniqueFieldException $ex) {
            return back()->with('error', $ex->getMessage());
        }

        return redirect()->route("banners.index")->with("success", $banner->name." updated !");
    }

    public function destroy($id)
    {
        $this->manageBannersService->deleteBanner($id);


        return redirect()->route("banners.index")->with("success", "Banner deleted !");
    }
}
