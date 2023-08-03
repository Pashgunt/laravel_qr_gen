<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FeedbackFilter extends QueryFilter
{
    public function company_id(int $id): Builder
    {
        return $this->builder->where('company_id', $id);
    }
}
