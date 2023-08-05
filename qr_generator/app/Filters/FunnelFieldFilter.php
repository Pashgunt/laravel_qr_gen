<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FunnelFieldFilter extends QueryFilter
{
    public function funnel_id(int $id): Builder
    {
        return $this->builder->where('funnel_config_id', $id);
    }

    public function field_id(int $id): Builder
    {
        return $this->builder->where('id', $id);
    }
}
