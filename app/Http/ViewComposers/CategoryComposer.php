<?php

namespace App\Http\ViewComposers;

use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * Create a category composer.
     *
     * @return void
     */
    public function __construct(private GetCategoriesService $getCategoriesService)
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('parentCategories', $this->getCategoriesService->getAllParentCategories());
    }
}
