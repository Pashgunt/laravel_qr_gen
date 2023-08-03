<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyFilter extends QueryFilter
{
    public function company_id(int $id): Builder
    {
        return $this->builder->where('id', $id);
    }
}
