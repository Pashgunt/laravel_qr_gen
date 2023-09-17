<?php

namespace App\View\Components\Dashboard\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Apps extends Component
{
    public function __construct(public string $id)
    {
    }
    
    public function render(): View|Closure|string
    {
        return view('components.dashboard.components.apps');
    }
}
