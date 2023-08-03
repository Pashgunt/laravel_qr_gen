<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FunnelTypeFilter extends QueryFilter
{
    public function funnel_type_id(int $id): Builder
    {
        return $this->builder->where('id', $id);
    }
}
