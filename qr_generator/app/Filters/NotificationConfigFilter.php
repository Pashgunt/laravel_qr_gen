<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NotificationConfigFilter extends QueryFilter
{

    public function company_id(int $company_id): Builder
    {
        return $this->builder->where('company_id', $company_id);
    }
}
