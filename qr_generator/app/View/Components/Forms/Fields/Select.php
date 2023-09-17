<?php

namespace App\View\Components\Forms\Fields;

use App\QR\Abstracts\ComponentClassesTrait;
use App\QR\Abstracts\ComponentFieldInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component implements ComponentFieldInterface
{
    use ComponentClassesTrait;

    public function __construct(
        public string $label,
        public string $showError,
        public string $name,
        public string $showErrorMessage,
        public string $requireMark = '0',
        public $companies,
        public string $defaultOption
    ) {
    }

    public function isShowError(): bool
    {
        return $this->showError === '1';
    }

    public function isShowErrorMessage(): bool
    {
        return $this->showErrorMessage === '1';
    }

    public function getClassLabelError(): string
    {
        return $this->isShowError() ? $this->getLabelErrorClassName() : '';
    }

    public function getClassInputError(): string
    {
        return $this->isShowError()
            ? $this->getInputErrorClassName()
            : '';
    }

    public function isShowRequireMark(): bool
    {
        return $this->requireMark === '1';
    }

    public function isSelected(
        ?string $value,
        ?string $oldValue
    ): bool {
        return $value === $oldValue;
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.fields.select');
    }
}
