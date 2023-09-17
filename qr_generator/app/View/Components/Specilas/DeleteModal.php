<?php

namespace App\View\Components\Specilas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    public function __construct(
        public string $id,
        public string $action,
        public string $title,
        public string $subtitle
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.specilas.delete-modal');
    }
}
