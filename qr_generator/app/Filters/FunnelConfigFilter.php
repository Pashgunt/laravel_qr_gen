<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FunnelConfigFilter extends QueryFilter
{
    public function company_id(int $id): Builder
    {
        return $this->builder->where('company_id', $id);
    }

    public function funnel_type(string $funnelType): Builder
    {
        return $this->builder->where('funnel_types.funnel_type_tag', $funnelType);
    }

    public function is_actual(int $isActual): Builder
    {
        return $this->builder->where('funnel_configs.is_actual', $isActual);
    }
}
