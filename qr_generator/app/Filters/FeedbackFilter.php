<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FeedbackFilter extends QueryFilter
{
    public function company_id(int $id): Builder
    {
        return $this->builder->where('company_id', $id);
    }

    public function is_actual(int $isActual): Builder
    {
        return $this->builder->where('is_actual', $isActual);
    }
}
