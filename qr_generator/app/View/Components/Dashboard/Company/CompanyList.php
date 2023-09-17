<?php

namespace App\View\Components\Dashboard\Company;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanyList extends Component
{

    public function __construct(public $companies)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.company.company-list');
    }
}
