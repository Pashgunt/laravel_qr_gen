<?php

namespace App\View\Components\Forms\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
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
        return $this->isShowError() ? 'text-red-500' : '';
    }

    public function getClassInputError(): string
    {
        return $this->isShowError()
            ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5'
            : '';
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.fields.input');
    }
}