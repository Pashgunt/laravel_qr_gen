<?php

namespace App\View\Components\Specilas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $title;
    public string $text;
    public string $button;

    public function __construct(
        string $title,
        string $text,
        string $button
    ) {
        $this->title = $title;
        $this->text = $text;
        $this->button = $button;
    }

    public function render(): View|Closure|string
    {
        return view('components.specilas.modal');
    }
}
