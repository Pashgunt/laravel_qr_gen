<?php

namespace App\View\Components\Specilas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Background extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.specilas.background');
    }
}
