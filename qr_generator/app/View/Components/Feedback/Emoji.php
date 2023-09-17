<?php

namespace App\View\Components\Feedback;

use App\QR\Abstracts\ComponentClassesTrait;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Emoji extends Component
{
    use ComponentClassesTrait;

    public function __construct(
        public string $name,
        public string $showError
    ) {
    }

    public function isChecked(
        ?string $oldValue,
        string $value
    ): bool {
        return $oldValue === $value;
    }

    public function isActive(
        ?string $oldValue,
        string $value
    ): string {
        return $oldValue !== $value ? $this->getInnactiveClassName() : '';
    }

    public function isShowError(): bool
    {
        return $this->showError === '1';
    }

    public function render(): View|Closure|string
    {
        return view('components.feedback.emoji');
    }
}
