<?php

namespace App\Repositories\Implementations;

use App\Exceptions\Banners\BannerNotFoundException;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepository;

class EloquentBannerRepository extends EloquentRepository implements BannerRepository
{
    public function __construct() {
        parent::__construct(Banner::class);
    }

    public function checkChildExists(string $id): bool {
        $Banner = $this->findById($id);

        if (!$Banner) throw new BannerNotFoundException();

        return $Banner->childs()->exists();
    }
}
