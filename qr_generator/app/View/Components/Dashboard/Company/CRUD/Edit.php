<?php

namespace App\View\Components\Dashboard\Company\CRUD;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public function __construct(public Company $company)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.company.c-r-u-d.edit');
    }
}
