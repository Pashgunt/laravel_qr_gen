<?php

namespace App\View\Components\Forms\Fields;

use App\QR\Abstracts\ComponentClassesTrait;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    use ComponentClassesTrait;

    public string $label;
    public string $showError;
    public string $name;
    public string $showErrorMessage;
    public string $placeholder;

    public function __construct(
        string $label,
        string $showError,
        string $name,
        string $showErrorMessage,
        string $placeholder
    ) {
        $this->label = $label;
        $this->showError = $showError;
        $this->name = $name;
        $this->showErrorMessage = $showErrorMessage;
        $this->placeholder = $placeholder;
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

    public function render(): View|Closure|string
    {
        return view('components.forms.fields.input');
    }
}
