<?php

namespace App\View\Components\Feedback;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Title extends Component
{
    public function __construct(
        public array $data,
        public string $showCompanyTable,
        public string $showCompanyAddress
    ) {
    }

    public function isShowcompanyTable(): bool
    {
        return $this->showCompanyTable === '1';
    }

    public function isShowCompanyAddress(): bool
    {
        return $this->showCompanyAddress === '1';
    }

    public function getCompanyName(): string
    {
        return $this->data['company']->name;
    }

    public function getTableNumber(): string
    {
        return $this->data['company_table']->table_number
            ? $this->data['company_table']->table_number
            : '-';
    }

    public function getCompanyAddress(): string
    {
        return $this->data['company']->adress;
    }

    public function render(): View|Closure|string
    {
        return view('components.feedback.title');
    }
}
