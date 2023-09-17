<?php

namespace App\View\Components\Dashboard\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideOver extends Component
{
    public function __construct(
        public string $title,
        public string $subtitle,
        public string $route
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.components.side-over');
    }
}
