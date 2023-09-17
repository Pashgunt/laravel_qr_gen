<?php

namespace App\View\Components\Dashboard\Company\CRUD;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Create extends Component
{
    public function __construct(public $companies)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.company.c-r-u-d.create');
    }
}
