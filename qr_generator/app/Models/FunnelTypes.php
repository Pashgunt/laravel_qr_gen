<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_type_tag',
        'funnel_type_name',
    ];

    protected $table = 'funnel_types';

    protected $hidden = [
        'created_at',
        'updated_at',
        'is_actual',
    ];

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
