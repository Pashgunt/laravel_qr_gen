<?php

namespace App\View\Components\Forms\Fields;

use App\QR\Abstracts\ComponentClassesTrait;
use App\QR\Abstracts\ComponentFieldInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Email extends Component implements ComponentFieldInterface
{
    use ComponentClassesTrait;

    public string $label;
    public string $showError;
    public string $name;
    public string $showErrorMessage;

    public function __construct(
        string $label,
        string $showError,
        string $name,
        string $showErrorMessage
    ) {
        $this->label = $label;
        $this->showError = $showError;
        $this->name = $name;
        $this->showErrorMessage = $showErrorMessage;
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
        return view('components.forms.fields.email');
    }
}
