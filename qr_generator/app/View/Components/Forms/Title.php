<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Title extends Component
{
    public string $separator;
    public string $title;

    public function isSeparate(): bool
    {
        return $this->separator === '1';
    }

    public function __construct(
        string $separator,
        string $title
    ) {
        $this->separator = $separator;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.title');
    }
}
