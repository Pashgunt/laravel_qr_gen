<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'funnel_type_id',
        'work_started_at',
    ];

    protected $table = 'funnel_configs';

    public function scopeJoined(Builder $builder): mixed
    {
        return $builder
            ->join('funnel_fields', 'funnel_configs.id', '=', 'funnel_fields.funnel_config_id')
            ->join('funnel_types', 'funnel_configs.funnel_type_id', '=', 'funnel_types.id')
            ->leftJoin('funnel_logic_blocks', 'funnel_fields.id', '=', 'funnel_logic_blocks.funnel_field_id');
    }

    public function scopeFilter(
        Builder $builder,
        QueryFilter $filter,
        array $additionalParams = []
    ) {
        return $filter->apply($builder, $additionalParams);
    }

    public function scopeGetResult(Builder $builder): Collection
    {
        return $builder->get([
            'funnel_fields.*',
            'funnel_logic_blocks.*',
            'funnel_types.*',
            'funnel_configs.*',
            'funnel_fields.id AS funnel_field_id',
        ]);
    }
}
