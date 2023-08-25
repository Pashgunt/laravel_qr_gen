<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FunnelTypeFilter extends QueryFilter
{
    public function funnel_type_id(int $id): Builder
    {
        return $this->builder->where('id', $id);
    }

    public function is_actual(int $isActual): Builder
    {
        return $this->builder->where('is_actual', $isActual);
    }
}
