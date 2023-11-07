<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class DeleteModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $id,
        public string $title,
        public string $body,
        public string $action,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.delete-modal');
    }
}
