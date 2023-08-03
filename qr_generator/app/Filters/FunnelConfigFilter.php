<?php

namespace App\Filters;

class FunnelConfigFilter extends QueryFilter
{
    public function company_id($id)
    {
        return $this->builder->where('company_id', $id)->join('funnel_fields', function ($join) {
            $join->on('funnel_configs.id', '=', 'funnel_fields.funnel_config_id');
        })->join('funnel_logic_blocks', function ($join) {
            $join->on('funnel_fields.id', '=', 'funnel_logic_blocks.funnel_field_id');
        })->join('funnel_types', 'funnel_configs.funnel_type_id', '=', 'funnel_types.id');
    }

    public function funnel_type(string $funnelType)
    {
        $this->builder->where('funnel_types.funnel_type_tag', $funnelType)->join('funnel_fields', function ($join) {
            $join->on('funnel_configs.id', '=', 'funnel_fields.funnel_config_id');
        })->join('funnel_logic_blocks', function ($join) {
            $join->on('funnel_fields.id', '=', 'funnel_logic_blocks.funnel_field_id');
        })->join('funnel_types', 'funnel_configs.funnel_type_id', '=', 'funnel_types.id');
    }
}
