<?php

namespace App\View\Components\Dashboard\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class UserMenu extends Component
{
    public function __construct(public string $id)
    {
    }

    public function getUserInfo(): User
    {
        return app(Request::class)->user();
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.components.user-menu');
    }
}
