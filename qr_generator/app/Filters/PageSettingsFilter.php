<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PageSettingsFilter extends QueryFilter
{
    public function company_id(int $companyID): Builder
    {
        return $this->builder->where('company_id', $companyID);
    }

    public function is_actual(int $isActual): Builder
    {
        return $this->builder->where('is_actual', $isActual);
    }

    public function page_type(string $pageType): Builder
    {
        return $this->builder->where('page_type', $pageType);
    }
}
