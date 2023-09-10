<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    public string $text;
    public string $class;

    public function __construct(
        string $text,
        string $class
    ) {
        $this->text = $text;
        $this->class = $class;
    }

    public function isCustomClass(): bool
    {
        return !!$this->class;
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.button');
    }
}
