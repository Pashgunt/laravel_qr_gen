<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelFields extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_config_id',
        'field_name',
        'operator',
        'value',
        'value_range_from',
        'value_range_to',
    ];

    protected $table = 'funnel_fields';

    public function scopeFilter(
        Builder $builder,
        QueryFilter $filter,
        array $additionalParams = []
    ) {
        return $filter->apply($builder, $additionalParams);
    }
}
