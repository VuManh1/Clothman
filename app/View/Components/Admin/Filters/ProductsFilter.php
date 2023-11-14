<?php

namespace App\View\Components\Admin\Filters;

use App\Services\Categories\Interfaces\GetCategoriesService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductsFilter extends Component
{
    public Collection $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $action,
        private GetCategoriesService $getCategoriesService
    )
    {
        $this->categories = $this->getCategoriesService->getCategories();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.filters.products-filter');
    }
}
